<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bobots = Bobot::all();
        $kriterias = Kriteria::with('bobots')->get();
        return view('moduls.dashboard.bobot', compact('bobots', 'kriterias'));
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
        $bobot = new Bobot();
        $bobot->kode_kriteria = $request->kode_kriteria;
        $bobot->nama_sub_kriteria = $request->nama_sub_kriteria;
        $bobot->bobot = $request->bobot;
        $bobot->save();

        toast('Data bobot baru telah ditambahkan!', 'success');

        return redirect()->route('bobot');
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
        $bobot = Bobot::findOrFail($id);
        $kriterias = Kriteria::all();
        $bobots = Bobot::all();

        return view('moduls.dashboard.bobot_edit', compact('bobot', 'kriterias', 'bobots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bobot = Bobot::findOrFail($id);
        $bobot->kode_kriteria = $request->kode_kriteria;
        $bobot->nama_sub_kriteria = $request->nama_sub_kriteria;
        $bobot->bobot = $request->bobot;
        $bobot->save();

        toast('Data bobot berhasil diperbarui!', 'success');

        return redirect()->route('bobot');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $bobot = Bobot::findOrFail($request->id);
        $bobot->delete();

        toast('Data bobot berhasil dihapuskan!', 'success');

        return redirect()->route('bobot');
    }
}
