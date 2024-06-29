@extends('layouts.main', [
    'title' => 'Login',
    'active' => 'Login',
])

@section('content')
    <script>
        window.onload = function() {
            if (performance.navigation.type === 1) {
                window.location.href = '/penilaian/user';
            }
        };
    </script>
    <section class="w-full mx-auto flex md:flex-row flex-col items-center justify-center h-full body relative">
        <div class="w-full px-16 py-5 top-0 fixed bg-white h-fit flex justify-between items-center z-50">
            <div class="flex gap-2 items-center">

                <img src="{{ asset('assets/images/sheep.png') }}" alt="Sheep Icon"
                    class="w-12 h-12 text-primary tracking-
[               -2px]">
                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Sistem Pendukung Keputusan Pemilihan
                    Pakan Domba</h2>
            </div>


            <div class="w-fit flex gap-2">
                {{-- <a href="{{route('login')}}" class="bg-primary text-white px-5 py-2 rounded-full text-lg font-medium"><i class='bx bxs-user-circle mr-2'></i>Login Sebagai Admin</a> --}}
                <a href="{{ route('penilaian.user') }}"
                    class="bg-primary text-white px-5 py-2 rounded-full text-lg font-medium"><i
                        class='bx bxs-pencil mr-2'></i>Tambah Penilaian</a>
            </div>
        </div>

        <div class="flex flex-col w-full relative h-full top-20 z-10">
            <div class="sm:px-6 w-full w-full max-w-7xl mx-auto">
                <div class="px-4 py-4 md:pt-12 md:pb-7 -mb-8">
                    <div class="flex items-start gap-2 w-full">
                        <i class='bx bxs-star text-5xl text-white'>
                        </i>
                        <div class="flex fl
e                           x-col gap-1">
                            <p tabindex="0"
                                class="focus:outline-none text-base sm:text-lg md:text-2xl text-white lg:text-3xl font-bold leading-normal text-gray-800 mt-2">
                                PENILAIAN</p>
                            <p class="text-gray-400 max-w-2xl">&nbsp;</p>
                        </div>
                    </div>
                </div>

                @if (sizeof($penilaians) > 1)
                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="w-full flex flex-col gap-3 mb-10">
                            <div class="flex gap-2 w-full items-center">
                                <i class='bx bxs-select-multiple text-3xl text-primary'></i>
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Pilihan Alternatif
                                </h2>
                            </div>



                            <div
                                class="sm:flex items-cente
                r                            justify-start gap-2">
                                <a href="{{ route('user') }}"
                                    class="focus:ring-2 focus:ring-offset-2 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-1 bg-primary hover:bg-primary focus:outline-none rounded">
                                    <p class="font-semibold leading-none text-white flex items-center gap-1">
                                        <i class='bx bxs-bar-chart-alt-2 text-lg'></i>
                                        <span>Pilih Alternatif</span>
                                    </p>
                                </a>
                            </div>
                        </div>

                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Ranking Alternatif
                                    Pakan</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Jenis Pakan</th>
                                        <th>Penilaian dari</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($rankAlternatives as $v => $values)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $v)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $v)
                                                        {{ $penilaian['penilaian_from'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $values }}</td>
                                            {{-- <td>
                                                {{ $ranks[$v] }}
                                            </td> --}}
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Jenis Pakan</th>
                                        <th>Penilaian dari</th>
                                        <th>Nilai</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">


                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Bobot Kriteria
                                    Alternatives</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($alternatives as $kode_alternatif => $bobots)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $kode_alternatif)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @foreach ($bobots as $bobot)
                                                <td>{{ $bobot }}</td>
                                            @endforeach
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Matriks Normalisasi
                                    (R)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($normalizedMatrix as $kode_alternatif => $values)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $kode_alternatif)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @foreach ($values as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Matriks Normalisasi
                                    Berbobot (Y)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($weightedNormalizedMatrix as $kode_alternatif => $values)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $kode_alternatif)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @foreach ($values as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Solusi Ideal Positif
                                    (A)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    <tr class="data-consume">
                                        <td>{{ $i }}</td>
                                        @foreach ($idealPositive as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Solusi Ideal Negatif
                                    (A)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    <tr class="data-consume">
                                        <td>{{ $i }}</td>
                                        @foreach ($idealNegative as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        @foreach ($kriterias as $kriteria)
                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Jarak Ideal Positif
                                    (S)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis pakan</th>
                                        <th>Jarak Ideal Positif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($distancesPositive as $kode_alternatif => $value)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $kode_alternatif)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $value }}</td>

                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis pakan</th>
                                        <th>Jarak Ideal Positif</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Jarak Ideal Negatif
                                    (S)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        <th>Jarak Ideal Negatif</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($distancesNegative as $kode_alternatif => $value)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $kode_alternatif)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $value }}</td>

                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        <th>Jarak Ideal Negatif</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>

                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Kedekatan Relatif
                                    Terhadap Solusi Ideal (V)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($preferenceValues as $kode_alternatif => $value)
                                        <tr class="data-consume">
                                            <td>{{ $i }}</td>
                                            <td>
                                                @foreach ($penilaians as $penilaian)
                                                    @if ($penilaian['kode_alternatif'] == $kode_alternatif)
                                                        {{ $penilaian['jenis_pakan'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $value }}</td>

                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pakan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>



@endsection
