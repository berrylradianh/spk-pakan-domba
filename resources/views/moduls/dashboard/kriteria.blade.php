@extends('layouts.main', [
'title' => 'Dashboard',
'active' => 'Kriteria'
])

@section('content')
<section class="flex w-full">
    @include('moduls.dashboard.layouts.sidebar', [
    'active' => 'Kriteria',
    'data' => sizeof($kriterias)
    ])
    <div class="flex flex-col w-full">
        <div class="sm:px-6 w-full">
            <div class="px-4 py-4 md:pt-12 md:pb-7 -mb-8">
                <div class="flex items-start gap-2 w-full">
                    <i class='bx bxs-purchase-tag-alt text-5xl text-primary'></i>
                    <div class="flex flex-col gap-1">
                        <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-2xl lg:text-3xl font-bold leading-normal text-gray-800 mt-1">
                            KRITERIA</p>
                        <p class="text-gray-400 max-w-2xl">&nbsp;</p>
                        <!-- <p class="text-gray-400 max-w-2xl">Kriteria
                            Menilai kandungan nutrisi, ketersediaan, harga, kesehatan, keamanan, dan kebutuhan spesifik pakan untuk optimalkan pemeliharaan domba.</p> -->
                        <div class="sm:flex items-center justify-start gap-2">
                            <button onclick="toggleModal('modal-id')" type="button" class="focus:ring-2 focus:ring-offset-2  mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-1 bg-primary hover:bg-primary focus:outline-none rounded">
                                <p class=" font-semibold leading-none text-white flex items-center gap-1"><i class='bx bx-plus text-lg'></i><span>Tambah Kriteria</span></p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">

                <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                    <table id="example" class="display w-full" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($kriterias as $kriteria)
                            <tr class="data-consume">
                                <td>{{ $i }}</td>
                                <td>{{ $kriteria['kode_kriteria'] }}</td>
                                <td>{{ $kriteria['nama_kriteria'] }}</td>
                                <td>{{ $kriteria['keterangan'] }}</td>
                                <td class="flex gap-2">
                                    <a href="{{ route('kriteria.edit', $kriteria['id']) }}" class="focus:ring-2 focus:ring-offset-2  mt-4 sm:mt-0 inline-flex items-start justify-start p-3 bg-primary hover:bg-primary focus:outline-none rounded"><i class='bx bxs-edit-alt text-white'></i></a>
                                    <form action="{{ route('kriteria.destroy') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $kriteria['id'] }}">
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
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="modal-id">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                <h3 class="text-2xl font-semibold">
                    Input Data Kriteria
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" onclick="toggleModal('modal-id')">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                        ×
                    </span>
                </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
                <form action="{{ route('kriteria.store') }}" class="flex flex-col gap-1" method="post">
                    @csrf

                    <div class="flex gap-1">
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">Kode Kriteria</label>
                            <input name="kode_kriteria" type="text" placeholder="Kode Kriteria" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full" />
                        </div>
                        <div class="mb-1 pt-0 w-full">
                            <label for="" class="text-blueGray-600 text-base font-medium">Nama Kriteria</label>
                            <input name="nama_kriteria" type="text" placeholder="Nama Kriteria" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full" />
                        </div>
                    </div>

                    <div class="mb-1 pt-0 w-full">
                        <label for="" class="text-blueGray-600 text-base font-medium">Keterangan</label>
                        <textarea name="keterangan" placeholder="Keterangan " rows="8" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full"></textarea>
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

<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>

<script type="text/javascript">
    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }
</script>
@endsection
