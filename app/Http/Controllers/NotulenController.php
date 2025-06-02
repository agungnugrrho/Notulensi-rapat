<?php

namespace App\Http\Controllers;

use App\Models\Notulen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;


class NotulenController extends Controller
{
    public function index()
    {
        $notulens = Notulen::all(); //data dikirim banyak jadi pake s beda kalo edit dibawah
        $notulens = Notulen::orderBy('created_at', 'asc')->get();
        return view('index',compact('notulens'));
    }

    public function show($id)
    {
        $notulen = Notulen::find($id);
        return response()->json($notulen);
    }


    public function create()
    {
        return view('frame1');
    }

    public function store(Request $request)
    {
        $request -> validate([
                'dateInput' => 'required',
                'timeInput' => 'required',
                'place' => 'required',
                'chairman' => 'required',
                'notulen' => 'required',
                'agenda' => 'required',
                'pembahasan' => 'required',
                'keputusan' => 'required',
                'keterangan' => 'required',
        ]);

        $notulen = new notulen();
        $notulen->dateInput = $request->dateInput;
        $notulen->timeInput = $request->timeInput;
        $notulen->place = $request->place;
        $notulen->chairman = $request->chairman;
        $notulen->notulen = $request->notulen;
        $notulen->agenda = $request->agenda;
        $notulen->pembahasan = $request->pembahasan;
        $notulen->keputusan = $request->keputusan;
        $notulen->keterangan = $request->keterangan;
        $notulen->slug = Str::slug($request->notulen);
        $notulen->save();
        return redirect()->route('notulen.index')->with("message", "Data berhasil ditambahkan!");
    }

    public function edit(string $id)
    {
        $notulen = notulen::find($id); //find untuk cari dan $notulen untuk data sedikit karna cuman edit
        return view ('update',compact('notulen'));
    }

    public function update(Request $request,string $id)
    {
        $notulen= Notulen::findOrFail($id);
        $request -> validate([
            'dateInput' => 'required',
            'timeInput' => 'required',
            'place' => 'required',
            'chairman' => 'required',
            'notulen' => 'required',
            'agenda' => 'required',
            'pembahasan' => 'required',
            'keputusan' => 'required',
            'keterangan' => 'required',
    ]);

    $notulen->dateInput = $request->dateInput;
    $notulen->timeInput = $request->timeInput;
    $notulen->place = $request->place;
    $notulen->chairman = $request->chairman;
    $notulen->notulen = $request->notulen;
    $notulen->agenda = $request->agenda;
    $notulen->pembahasan = $request->pembahasan;
    $notulen->keputusan = $request->keputusan;
    $notulen->keterangan = $request->keterangan;
    $notulen->slug = Str::slug($request->notulen);
    $notulen->save();
    return redirect()->route('notulen.index')->with("message", "Data berhasil diubah!");
}


}
