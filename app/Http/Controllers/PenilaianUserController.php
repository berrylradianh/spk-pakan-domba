<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pakan;
use App\Models\Penilaian;
use App\Models\PenilaianUser;
use Illuminate\Http\Request;

class PenilaianUserController extends Controller
{
    protected $weightCriteria = [
        0.4,
        0.2,
        0.05,
        0.2,
        0.05,
        0.05,
        0.05
    ];

    // Langkah 0 : Generate Matrix Alternatif yang dipilih
    public function generateAlternatives($data)
    {
        $alternatives = [];
        foreach ($data as $entry) {
            $kode_alternatif = $entry['kode_alternatif'];
            $bobot = array_map('intval', explode(', ', $entry['bobot']));
            $alternatives[$kode_alternatif] = $bobot;
        }
        return $alternatives;
    }

    // Langkah 1 : Fungsi untuk melakukan normalisasi matriks keputusan
    function normalizeMatrix($matrix)
    {
        $normalized = [];
        $columnSums = array_fill(0, count(current($matrix)), 0);

        // Menghitung jumlah kuadrat untuk setiap kolom
        foreach ($matrix as $row) {
            foreach ($row as $j => $value) {
                $columnSums[$j] += $value ** 2;
            }
        }

        // Menghitung faktor normalisasi untuk setiap kolom
        $normalizationFactors = array_map('sqrt', $columnSums);

        // Melakukan normalisasi matriks
        foreach ($matrix as $key => $row) {
            foreach ($row as $j => $value) {
                $normalized[$key][$j] = $value / $normalizationFactors[$j];
            }
        }

        return $normalized;
    }

    // Langah 2 : Fungsi untuk membentuk matriks keputusan ternormalisasi terbobot
    function weightedNormalizedMatrix($normalizedMatrix, $criteriaWeights)
    {
        $weightedMatrix = [];
        foreach ($normalizedMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $weightedMatrix[$i][$j] = $value * array_values($criteriaWeights)[$j];
            }
        }
        return $weightedMatrix;
    }

    // Langkah 3 : Fungsi Menentukan Solusi Ideal Positif dan Negatif
    function idealSolutions($weightedMatrix)
    {
        $idealPositive = [];
        $idealNegative = [];

        for ($j = 0; $j < count(current($weightedMatrix)); $j++) {
            $column = array_column($weightedMatrix, $j);
            $idealPositive[$j] = max($column);
            $idealNegative[$j] = min($column);
        }

        return [$idealPositive, $idealNegative];
    }

    // Langkah 4 : Menghitung Jarak antara Setiap Alternatif dengan Solusi Ideal Positif dan Negatif
    function calculateDistances($matrix, $idealPositive, $idealNegative)
    {
        $distancesPositive = [];
        $distancesNegative = [];

        foreach ($matrix as $key => $row) {
            $sumPos = 0;
            $sumNeg = 0;
            foreach ($row as $j => $value) {
                $sumPos += ($value - $idealPositive[$j]) ** 2;
                $sumNeg += ($value - $idealNegative[$j]) ** 2;
            }
            $distancesPositive[$key] = sqrt($sumPos);
            $distancesNegative[$key] = sqrt($sumNeg);
        }

        return [$distancesPositive, $distancesNegative];
    }

    // Langkah 5 : Fungsi untuk menghitung nilai preferensi untuk setiap alternatif
    function preferenceValues($distancesPositive, $distancesNegative)
    {
        $closenessCoefficient = [];

        foreach ($distancesPositive as $key => $distancePos) {
            $distanceNeg = $distancesNegative[$key];
            $closenessCoefficient[$key] = $distanceNeg / ($distancePos + $distanceNeg);
        }

        // Sort the closeness coefficients in descending order
        arsort($closenessCoefficient);

        return $closenessCoefficient;
    }

    // Langkah 6 : Fungsi untuk mengurutkan alternatif berdasarkan nilai preferensi
    function rankAlternatives($preferenceValues)
    {
        // Mengurutkan nilai preferensi dalam urutan menurun
        arsort($preferenceValues);

        // Mengembalikan alternatif yang sudah diurutkan
        return $preferenceValues;
    }

    /**
     * Display a listing of the resource.
     */

    private function sortValue($preferenceValues)
    {
        // Create an array with alternatives and their corresponding preference values
        $rankedAlternatives = [];
        foreach ($preferenceValues as $alternative => $preferenceValue) {
            $rankedAlternatives[] = ['alternative' => $alternative, 'preferenceValue' => $preferenceValue];
        }

        // Sort the array by preference value in descending order
        usort($rankedAlternatives, function ($a, $b) {
            return $b['preferenceValue'] <=> $a['preferenceValue'];
        });

        // Assign ranks
        foreach ($rankedAlternatives as $index => $alternative) {
            $rankedAlternatives[$index]['rank'] = $index + 1;
        }

        return $rankedAlternatives;
    }


    public function index()
    {
        $penilaians = PenilaianUser::all();
        if (PenilaianUser::count() > 2) {
            $alternatives = $this->generateAlternatives($penilaians);
            $normalizedMatrix = $this->normalizeMatrix($alternatives);
            $weightedNormalizedMatrix = $this->weightedNormalizedMatrix($normalizedMatrix, $this->weightCriteria);

            list($idealPositive, $idealNegative) = $this->idealSolutions($weightedNormalizedMatrix);

            list($distancesPositive, $distancesNegative) = $this->calculateDistances($weightedNormalizedMatrix, $idealPositive, $idealNegative);

            $preferenceValues = $this->preferenceValues($distancesPositive, $distancesNegative);
            $rankAlternatives = $this->rankAlternatives($preferenceValues);

            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.dashboard.penilaian.manual', compact('penilaians', 'pakans', 'kriterias', 'alternatives', 'normalizedMatrix', 'weightedNormalizedMatrix', 'idealPositive', 'idealNegative', 'distancesPositive', 'distancesNegative', 'preferenceValues', 'rankAlternatives'));
        } else {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.dashboard.penilaian.manual', compact('penilaians', 'pakans', 'kriterias',));
        }
    }


    public function user()
    {
        $penilaians = PenilaianUser::all();

        if ($penilaians->count() > 1) {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.user.penilaian.manual', compact('penilaians', 'pakans', 'kriterias'));
        } else {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.user.penilaian.manual', compact('penilaians', 'pakans', 'kriterias'));
        }
    }

    public function generateRanking(Request $request)
    {
        $selectedPenilaianIds = $request->input('selected_penilaians', []);
        // $selectedPenilaianUserIds = $request->input('selected_penilaian_users', []);
        // $penilaians = [];
        $penilaians = PenilaianUser::whereIn('id', $selectedPenilaianIds)->get();
        // $penilaian_users = Penilaian::whereIn('id', $selectedPenilaianIds)->get();
        // dd($penilaian_users);

        // Convert the collections to arrays if they are not already
        // $penilaian_admins_array = $penilaian_admins->toArray();
        // $penilaian_users_array = $penilaian_users->toArray();

        // Merge the arrays into the $penilaians array
        // $penilaians = array_merge($penilaian_admins_array, $penilaian_users_array);

        if ($penilaians->count() > 1) {
            $alternatives = $this->generateAlternatives($penilaians);
            $normalizedMatrix = $this->normalizeMatrix($alternatives);
            $weightedNormalizedMatrix = $this->weightedNormalizedMatrix($normalizedMatrix, $this->weightCriteria);

            list($idealPositive, $idealNegative) = $this->idealSolutions($weightedNormalizedMatrix);

            list($distancesPositive, $distancesNegative) = $this->calculateDistances($weightedNormalizedMatrix, $idealPositive, $idealNegative);

            $preferenceValues = $this->preferenceValues($distancesPositive, $distancesNegative);
            $rankAlternatives = $this->rankAlternatives($preferenceValues);

            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.user.ranking', compact('penilaians', 'pakans', 'kriterias', 'alternatives', 'normalizedMatrix', 'weightedNormalizedMatrix', 'idealPositive', 'idealNegative', 'distancesPositive', 'distancesNegative', 'preferenceValues', 'rankAlternatives'));
        } else {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.user.ranking', compact('penilaians', 'pakans', 'kriterias'));
        }
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
        $kode_alternatif = $request->input('kode_alternatif');
        $jenis_pakan = $request->input('jenis_pakan');
        // list($kode_alternatif, $jenis_pakan) = explode(',', $combinedValue);

        $kode_exist = PenilaianUser::where('kode_alternatif', $kode_alternatif)->first();
        if ($kode_exist) {
            toast('Kode Alternatif sudah dipakai !', 'error');
            return redirect()->route('penilaian.user');
        }

        $kode_pakan_exist = Pakan::where('kode_alternatif', $kode_alternatif)->first();
        if ($kode_pakan_exist) {
            toast('Kode Alternatif sudah dipakai !', 'error');
            return redirect()->route('penilaian.user');
        }

        $penilaian = new PenilaianUser();
        $penilaian->kode_alternatif = $kode_alternatif;
        $penilaian->jenis_pakan = $jenis_pakan;

        $bobotArray = $request->input('kode_kriteria');
        $penilaian->bobot = implode(', ', $bobotArray);

        $penilaian->save();

        toast('Alternatif penilaian baru telah ditambahkan!', 'success');

        return redirect()->route('penilaian.user');
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
        $penilaian = PenilaianUser::findOrFail($id);
        $pakans = Pakan::all();
        $kriterias = Kriteria::with('bobots')->get();
        return view('moduls.dashboard.penilaian.manual', compact('penilaian', 'pakans', 'kriterias'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penilaian = PenilaianUser::findOrFail($id);

        $penilaian->kode_alternatif = $request->input('kode_alternatif');
        $penilaian->jenis_pakan = $request->input('jenis_pakan');

        $penilaian->save();

        toast('Alternatif penilaian berhasil diperbarui!', 'success');

        return redirect()->route('penilaian.user');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $penilaian = PenilaianUser::findOrFail($request->id);
        $penilaian->delete();

        toast('Alternatif penilaian berhasil dihapuskan!', 'success');

        return redirect()->route('penilaian.user');
    }
}
