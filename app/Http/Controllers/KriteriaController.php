<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('moduls.dashboard.kriteria', compact('kriterias'));
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
        $kriteria = new Kriteria();
        $kriteria->kode_kriteria = $request->kode_kriteria;
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->keterangan = $request->keterangan;
        $kriteria->save();

        toast('Data kriteria baru telah ditambahkan!', 'success');

        return redirect()->route('kriteria');
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
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriterias = Kriteria::all(); // Add this line to pass $kriterias to the view
        return view('moduls.dashboard.kriteria_edit', compact('kriteria', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->kode_kriteria = $request->kode_kriteria;
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->keterangan = $request->keterangan;
        $kriteria->save();

        toast('Data kriteria telah diperbarui!', 'success');

        return redirect()->route('kriteria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $kriteria = Kriteria::findOrFail($request->id);
        $kriteria->delete();

        toast('Data kriteria berhasil dihapuskan!', 'success');

        return redirect()->route('kriteria');
    }
}
