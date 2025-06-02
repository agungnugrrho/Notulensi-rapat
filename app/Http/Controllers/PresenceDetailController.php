<?php

namespace App\Http\Controllers;

use App\Models\NotulenDetail;
use App\Models\Notulen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresenceDetailController extends Controller
{
    public function exportpdf(string $id)
    {
        $notulen = Notulen::findOrFail($id);
        $notulenDetail = NotulenDetail::where('presence_id', $notulen->id)->get();


        //load view to pdf
        $pdf = Pdf::setOptions(['isRemoteEnabled' => true])
            ->loadView('export-pdf', compact('notulen', 'notulenDetail'))
            ->setPaper('a4', 'landscape');

            return $pdf->stream("{$notulen->nama_kegiatan}.pdf");
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
