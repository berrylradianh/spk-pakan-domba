<?php

namespace App\Http\Controllers;

use App\Exports\ConsumeExport;
use App\Http\Requests\LoginRequest;
use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Pakan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::count();
        $bobots = Bobot::count();
        $pakans = Pakan::count();
        return view('moduls.dashboard.index', compact('kriterias', 'bobots', 'pakans'));
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();
            $role = $user->role_id == 1 ? 'admin' : 'user';
            toast('Selamat datang, ' . $user->name . '! Anda berhasil login sebagai ' . ucfirst($role) . '.', 'success');
            if ($user->role_id == 1) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('user');
            }
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        toast('Berhasil logout dari dashboard!', 'success');
        return redirect('login');
    }

    public function store(Request $request)
    {
        // dd($request);
        $kriteria = new Kriteria();
        $kriteria->kode_kriteria = $request->kode_kriteria;
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->keterangan = $request->keterangan;
        $kriteria->save();

        toast('Data kriteria baru telah ditambahkan!', 'success');

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
    }

    public function update(Request $request)
    {
    }


    public function destroy(Request $request)
    {
        $kriteria = Kriteria::findOrFail($request->id);
        $kriteria->delete();

        toast('Data kriteria berhasil dihapuskan!', 'success');

        return redirect()->route('kriteria');
    }
}
