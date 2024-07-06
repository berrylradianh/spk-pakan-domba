<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pakan;
use App\Models\Penilaian;
use App\Models\PenilaianUser;
use Illuminate\Http\Request;

class PenilaianController extends Controller
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

    //fungsi ranking
    function getRank($preferenceValues)
    {
        // Sort the array in descending order by value
        arsort($preferenceValues);

        // Initialize rank counter
        $rank = 1;

        // Create an array to store the ranked alternatives
        $rankedAlternatives = [];

        // Assign ranks to the alternatives
        foreach ($preferenceValues as $alternative => $value) {
            $rankedAlternatives[$alternative] = $rank;
            $rank++;
        }

        return $rankedAlternatives;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaians = Penilaian::all();
        if (Penilaian::count() > 2) {
            $alternatives = $this->generateAlternatives($penilaians);
            $normalizedMatrix = $this->normalizeMatrix($alternatives);
            $weightedNormalizedMatrix = $this->weightedNormalizedMatrix($normalizedMatrix, $this->weightCriteria);

            list($idealPositive, $idealNegative) = $this->idealSolutions($weightedNormalizedMatrix);

            list($distancesPositive, $distancesNegative) = $this->calculateDistances($weightedNormalizedMatrix, $idealPositive, $idealNegative);

            $preferenceValues = $this->preferenceValues($distancesPositive, $distancesNegative);
            // dd($preferenceValues);
            $rankAlternatives = $this->rankAlternatives($preferenceValues);
            // $ranks = $this->getRank($preferenceValues);

            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.dashboard.penilaian', compact('penilaians', 'pakans', 'kriterias', 'alternatives', 'normalizedMatrix', 'weightedNormalizedMatrix', 'idealPositive', 'idealNegative', 'distancesPositive', 'distancesNegative', 'preferenceValues', 'rankAlternatives'));
        } else {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.dashboard.penilaian', compact('penilaians', 'pakans', 'kriterias',));
        }
    }


    public function user()
    {
        $penilaians = Penilaian::all();
        $penilaian_users = PenilaianUser::all();

        if ($penilaians->count() > 1) {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.user.penilaian', compact('penilaians', 'pakans', 'kriterias', 'penilaian_users'));
        } else {
            $pakans = Pakan::all();
            $kriterias = Kriteria::with('bobots')->get();
            return view('moduls.user.penilaian', compact('penilaians', 'pakans', 'kriterias', 'penilaian_users'));
        }
    }

    public function generateRanking(Request $request)
    {
        $selectedPenilaianIds = $request->input('selected_penilaians', []);
        $selectedPenilaianUserIds = $request->input('selected_penilaian_users', []);
        // $penilaians = [];
        $penilaian_admins = Penilaian::whereIn('id', $selectedPenilaianIds)->get();
        $penilaian_admins = $penilaian_admins->map(function ($item) {
            $item->penilaian_from = 'admin';

            return $item;
        });
        $penilaian_users = PenilaianUser::whereIn('id', $selectedPenilaianUserIds)->get();
        $penilaian_users = $penilaian_users->map(function ($item) {
            $item->penilaian_from = 'user';

            return $item;
        });

        $penilaians = $penilaian_admins->merge($penilaian_users);

        if ($penilaians->count() > 1) {
            $alternatives = $this->generateAlternatives($penilaians);
            // dd($alternatives);
            $normalizedMatrix = $this->normalizeMatrix($alternatives);
            $weightedNormalizedMatrix = $this->weightedNormalizedMatrix($normalizedMatrix, $this->weightCriteria);

            list($idealPositive, $idealNegative) = $this->idealSolutions($weightedNormalizedMatrix);

            list($distancesPositive, $distancesNegative) = $this->calculateDistances($weightedNormalizedMatrix, $idealPositive, $idealNegative);

            $preferenceValues = $this->preferenceValues($distancesPositive, $distancesNegative);
            $rankAlternatives = $this->rankAlternatives($preferenceValues);
            // $ranks = $this->getRank($rankAlternatives);
            // dd($ranks);

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
        $combinedValue = $request->input('kode_alternatif');
        list($kode_alternatif, $jenis_pakan) = explode(',', $combinedValue);

        $penilaian = new Penilaian();
        $penilaian->kode_alternatif = $kode_alternatif;
        $penilaian->jenis_pakan = $jenis_pakan;

        $bobotArray = $request->input('kode_kriteria');
        $penilaian->bobot = implode(', ', $bobotArray);

        $penilaian->save();

        toast('Alternatif penilaian baru telah ditambahkan!', 'success');

        return redirect()->route('penilaian');
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
        $penilaian = Penilaian::findOrFail($id);
        $kriterias = Kriteria::all();
        return view('moduls.dashboard.penilaian_edit', compact('penilaian', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->kode_alternatif = $request->input('kode_alternatif');
        $penilaian->jenis_pakan = $request->input('jenis_pakan');

        $penilaian->save();

        toast('Alternatif penilaian berhasil diperbarui!', 'success');

        return redirect()->route('penilaian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $penilaian = Penilaian::findOrFail($request->id);
        $penilaian->delete();

        toast('Alternatif penilaian berhasil dihapuskan!', 'success');

        return redirect()->route('penilaian');
    }
}
