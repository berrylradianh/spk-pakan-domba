<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakans = Pakan::all();
        return view('moduls.dashboard.pakan', compact('pakans'));
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
        $pakan = new Pakan();
        $pakan->kode_alternatif = $request->kode_alternatif;
        $pakan->jenis_pakan = $request->jenis_pakan;
        $pakan->save();

        toast('Data pakan baru telah ditambahkan!', 'success');

        return redirect()->route('pakan');
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
    public function destroy(Request $request)
    {
        $pakan = Pakan::findOrFail($request->id);
        $pakan->delete();

        toast('Data pakan berhasil dihapuskan!', 'success');

        return redirect()->route('pakan');
    }
}
