<?php

namespace App\Http\Controllers;

use App\Models\Notulen;
use App\Models\NotulenDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class absenController extends Controller
{
    public function index($id)
    {
        $notulen = Notulen::findOrFail($id);
        $notulenDetail = NotulenDetail::where('presence_id', $notulen->id)->get();
        return view('absen-detail', compact('notulen', 'notulenDetail'));
        // return view('frame2', compact('notulen', 'notulenDetail'));
    }

    public function show($id){

        $notulen = Notulen::findOrFail($id);
        $notulenDetail = NotulenDetail::where('presence_id', $notulen->id)->get();
        return view('frame2', compact('notulen', 'notulenDetail'));
    }

    public function store(Request $request, string $id)
    {
        $notulen = Notulen::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tanda_tangan' => 'required'
        ]);

        $notulenDetail = new NotulenDetail();
        $notulenDetail->presence_id = $notulen->id;
        $notulenDetail->nama = $request->nama;
        $notulenDetail->jabatan = $request->jabatan;

        $base64_image = $request->tanda_tangan;
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        if ($file_data) {
            $uniqChar = date('YmdHis') . uniqid();
            $tanda_tangan = "tanda_tangan/{$uniqChar}.png";
            Storage::disk('public_uploads')->put($tanda_tangan, base64_decode($file_data));
            $notulenDetail->tanda_tangan = $uniqChar . '.png';
        }

        $notulenDetail->save();

        return redirect()->route('absen.show', $id)->with('success', 'Data berhasil disimpan!');
    }
}




// class absenController extends Controller
// {
//     public function index($id)
//     {
//         $notulen= Notulen::findOrFail($id);
//         $notulenDetail = NotulenDetail::where('presence_id', $notulen->id)->get();
//         return view('frame2', compact('notulen', 'notulenDetail'));
//     }

//     public function store(Request $request, string $id)
//      {
//          $notulen = Notulen::findOrFail($id);
//          $request->validate([
//              'nama' => 'required',
//              'jabatan' => 'required',
//             'tanda_tangan' => 'required',
//          ]);

//          $notulenDetail = new notulenDetail();
//          $notulenDetail->presence_id = $notulen->id;
//          $notulenDetail->nama = $request->nama;
//          $notulenDetail->jabatan = $request->jabatan;

//     //decode image base64
//         $base64_image = $request->tanda_tangan;
//         @list($type, $file_data) = explode(';', $base64_image);
//         @list(, $file_data) = explode(',', $file_data);

//     //generate file name
//         $uniqChar= date('YmdHis').uniqid();
//         $tanda_tangan = "tanda_tangan/{$uniqChar}.png";

//     // Periksa apakah ada file yang diupload
//     if ($request->hasFile('tanda_tangan')) {
//         $file = $request->file('tanda_tangan');

//         // validasi tipe file gambar
//         $request->validate([
//             'tanda_tangan' => 'required|image|mimes:png,jpg,jpeg|max:2048', // Batas 2MB
//         ]);

//         // Simpan file ke dalam folder uploads dengan nama unik
//         $fileName = 'tanda_tangan' . time() . '.' . $file->getClientOriginalExtension();
//         $file->move(public_path('uploads/tanda_tangan'), $fileName);

//         // Simpan path ke database
//         $notulenDetail->tanda_tangan = $fileName;
//     } else {
//         return back()->withErrors(['tanda_tangan' => 'File tanda tangan wajib diunggah.']);
//     }


//          $notulenDetail->tanda_tangan = $tanda_tangan;
//          $notulenDetail->save();

//          return redirect()->route('absen.index', ['id'=> $id]);
//     }
// }

