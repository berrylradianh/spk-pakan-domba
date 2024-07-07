@extends('layouts.main', [
'title' => 'Dashboard',
'active' => 'Penilaian',
])

@section('content')
<script>
    function validateForm() {
        const checkboxes = document.querySelectorAll('input[name="selected_penilaians[]"]:checked');
        if (checkboxes.length == 0) {
            alert('Harap pilih alternatif terlebih dahulu');
            return false;
        } else if (checkboxes.length == 1) {
            alert('Harap pilih lebih dari satu alternatif');
            return false;
        }
        return true;
    }
</script>

<section class="w-full bg-primary mx-auto flex md:flex-row flex-col items-center justify-center h-full body relative">
    <div class="w-full px-16 py-5 top-0 fixed bg-white h-fit flex justify-between items-center z-50">
        <div class="flex gap-2 items-center">

            <img src="{{ asset('assets/images/sheep.png') }}" alt="Sheep Icon" class="w-12 h-12 text-primary tracking-
[               -2px]">
            <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Sistem Pendukung Keputusan Pemilihan
                Pakan Domba</h2>
        </div>

        <div class="w-fit flex gap-2">
            {{-- <a href="{{route('login')}}" class="bg-primary text-white px-5 py-2 rounded-full text-lg font-medium"><i class='bx bxs-user-circle mr-2'></i>Login Sebagai Admin</a> --}}
            <a href="{{ route('user') }}" class="bg-primary text-white px-5 py-2 rounded-full text-lg font-medium"><i class='bx bxs-pencil mr-2'></i>Lakukan Penilaian Alternatif</a>
        </div>

    </div>

    <div class="flex flex-col w-full relative h-full top-20 z-10">
        <div class="sm:px-6 w-full w-full max-w-7xl mx-auto">
            <div class="px-4 py-4 md:pt-12 md:pb-7">
                <div class="flex items-start gap-2 w-full">
                    <i class='bx bxs-star text-5xl text-white'>
                    </i>
                    <div class="flex fl
e                           x-col gap-1">
                        <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-2xl text-white lg:text-3xl font-bold leading-normal text-gray-800 mt-2 mb-5">
                            PENILAIAN</p>
                        <p class="text-gray-400 max-w-2xl">&nbsp;</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full rounded-lg bg-white">
                <div class="sm:px-6 w-full max-w-6xl">
                    <div class="px-4 py-4 md:pt-10 md:pb-7 -mb-8">
                        <div class="flex items-start gap-2 w-full">
                            <div class="flex flex-col gap-1 ml-6">

                                <p class="text-gray-400 max-w-2xl">&nbsp;</p>
                                <!-- <p class="text-gray-400 max-w-2xl">Pakan
                                    Memilih pakan berkualitas berdasarkan kandungan nutrisi, ketersediaan, harga, kesehatan, keamanan, dan kebutuhan spesifik domba.</p> -->
                                <div class="sm:flex items-center justify-start gap-2">
                                    <button onclick="toggleModal('modal-id')" type="button" class="focus:ring-2 focus:ring-offset-2  mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-1 bg-primary hover:bg-primary focus:outline-none rounded">
                                        <p class=" font-semibold leading-none text-white flex items-center gap-1"><i class='bx bx-plus text-lg'></i><span>Tambah Alternatif</span></p>
                                    </button>
                                    <button onclick="toggleModal2('modal-id2')" type="button" class="focus:ring-2 focus:ring-offset-2  mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-1 bg-primary hover:bg-primary focus:outline-none rounded">
                                        <p class=" font-semibold leading-none text-white flex items-center gap-1"><i class='bx bxs-bar-chart-alt-2 text-lg'></i></i><span>Generate
                                                Ranking</span></p>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <table id="example" class="display w-full" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Alternatif</th>
                                        <th>Jenis Pakan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($penilaians as $penilaian)
                                    <tr class="data-consume">
                                        <td>{{ $i }}</td>
                                        <td>{{ $penilaian['kode_alternatif'] }}</td>
                                        <td>{{ $penilaian['jenis_pakan'] }}</td>
                                        <td class="flex gap-2">
                                            <button onclick="toggleModal3('modal-id3')" type="button" class="focus:ring-2 focus:ring-offset-2 mt-4 sm:mt-0 inline-flex items-start justify-start p-3 bg-primary hover:bg-primary focus:outline-none rounded">
                                                <i class='bx bxs-edit-alt text-white'></i>
                                            </button>
                                            <form action="{{ route('penilaian.user.destroy') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $penilaian['id'] }}">
                                                <button type="submit" class="focus:ring-2 focus:ring-offset-2  mt-4 sm:mt-0 inline-flex items-start justify-start p-3 bg-red-500 hover:bg-red-500 focus:outline-none rounded">
                                                    <i class='bx bxs-trash-alt text-white'></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Alternatif</th>
                                        <th>Jenis Pakan</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    @if (sizeof($penilaians) > 2)
                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                            <div class="flex gap-2 w-full mb-3 items-center">
                                <i class='bx bxs-data text-3xl text-primary'></i>
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Alternatives
                                </h2>
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Matriks
                                    Normalisasi (R)
                                </h2>
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Matriks
                                    Normalisasi
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Solusi Ideal
                                    Positif (A)
                                </h2>
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Solusi Ideal
                                    Negatif (A)
                                </h2>
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Jarak Ideal
                                    Positif (S)
                                </h2>
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Jarak Ideal
                                    Negatif (S)
                                </h2>
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
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Kedekatan
                                    Relatif
                                    Terhadap
                                    Solusi Ideal (V)</h2>
                            </div>
                            <table class="display w-full example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
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
                                        <th>Ranking</th>
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
        </div>
    </div>
</section>

<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id3">
    <div id="modal-id3-backdrop" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur hidden"></div>
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-2xl font-semibold">
                    Edit Alternatif
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id3')">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                        ×
                    </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <form action="{{ route('penilaian.user.update', ['id' => $penilaian->id]) }}" class="flex flex-col w-full gap-1" method="post">
                    @csrf
                    <div class="grid grid-cols-2 gap-1">
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">Kode Alternatif</label>
                            <input name="kode_alternatif" id="" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full" value="{{ $penilaian['kode_alternatif'] }}">
                        </div>
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">Jenis Pakan</label>
                            <input name="jenis_pakan" id="" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full" value="{{ $penilaian['jenis_pakan'] }}">
                        </div>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end pt-3 border-t border-solid border-blueGray-200 rounded-b">
                        <button class="text-gray-500 background-transparent font-bold px-6 py-2 text-base outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id3')">
                            Close
                        </button>
                        <button type="submit" class="focus:ring-2 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-primary hover:bg-primary focus:outline-none rounded">
                            <p class="text-base font-semibold leading-none text-white">Simpan Data</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-2xl font-semibold">
                    Tambah Alternatif
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                        ×
                    </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <form action="{{ route('penilaian.user.store') }}" class="flex flex-col w-full gap-1" method="post">
                    @csrf


                    <div class="grid grid-cols-2 gap-1">
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">Kode Alternatif</label>
                            <input name="kode_alternatif" id="" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full">
                        </div>
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">Jenis Pakan</label>
                            <input name="jenis_pakan" id="" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-1">
                        @foreach ($kriterias as $kriteria)
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">{{ $kriteria->nama_kriteria }}</label>
                            <select name="kode_kriteria[]" id="" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full">
                                <option value="">Pilih Subkriteria</option>
                                @foreach ($kriteria->bobots as $bobot)
                                <option value="{{ $bobot->bobot }}">{{ $bobot->nama_sub_kriteria }} -
                                    {{ $bobot->bobot }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>




                    <!--footer-->
                    <div class="flex items-center justify-end pt-3 border-t border-solid border-blueGray-200 rounded-b">
                        <button class="text-gray-500 background-transparent font-bold  px-6 py-2 text-base outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="toggleModal('modal-id')">
                            Close
                        </button>
                        <button type="submit" class="focus:ring-2  mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-primary hover:bg-primary focus:outline-none rounded">
                            <p class="text-base font-semibold leading-none text-white">Simpan Data</p>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@if (sizeof($penilaians) > 2)
<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id2">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-2xl font-semibold">
                    Ranking
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal2('modal-id2')">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                        ×
                    </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <form action="{{ route('penilaian.user.store') }}" class="flex flex-col w-full gap-1" method="post">
                    @csrf
                    <table class="display w-full example" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alternatif Pakan</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp

                            @foreach ($rankAlternatives as $kode_alternatif => $value)
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
                                <th>Alternatif Pakan</th>
                                <th>Nilai</th>
                            </tr>
                        </tfoot>
                    </table>
                    <!--footer-->
                    <div class="flex items-center justify-end pt-3 border-t border-solid border-blueGray-200 rounded-b">
                        <button type="button" onclick="toggleModal2('modal-id2')" class="focus:ring-2  mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-primary hover:bg-primary focus:outline-none rounded">
                            <p class="text-base font-semibold leading-none text-white">Close</p>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endif
















<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id2-backdrop"></div>

<script type="text/javascript">
    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }

    function toggleModal2(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }

    function toggleModal3(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
@endsection
