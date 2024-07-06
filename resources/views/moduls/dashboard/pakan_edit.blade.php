@extends('layouts.main', [
    'title' => 'Edit Pakan',
    'active' => 'Pakan Domba'
])

@section('content')
<section class="flex w-full">
    @include('moduls.dashboard.layouts.sidebar', ['active' => 'Pakan Domba', 'data' => sizeof($pakans)])
    <div class="flex flex-col w-full">
        <div class="sm:px-6 w-full">
            <div class="px-4 py-4 md:pt-12 md:pb-7 -mb-8">
                <div class="flex items-start gap-2 w-full">
                    <i class='bx bxs-bowl-rice text-5xl text-primary'></i>
                    <div class="flex flex-col gap-1">
                        <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-2xl lg:text-3xl font-bold leading-normal text-gray-800 mt-1">
                            EDIT PAKAN
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                <div class="overflow-x-auto w-full min-w-full box bg-white p-8 rounded-lg">
                    <form action="{{ route('pakan.update', $pakan->id) }}" method="post">
                        @csrf
                        <div class="flex gap-1">
                            <div class="mb-1 pt-0 w-full">
                                <label for="kode_alternatif" class="text-blueGray-600 text-base font-medium">Kode Alternatif</label>
                                <input name="kode_alternatif" type="text" id="kode_alternatif" value="{{ $pakan->kode_alternatif }}" placeholder="Kode Alternatif" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full" />
                            </div>
                            <div class="mb-1 pt-0 w-full">
                                <label for="jenis_pakan" class="text-blueGray-600 text-base font-medium">Jenis Pakan</label>
                                <input name="jenis_pakan" type="text" id="jenis_pakan" value="{{ $pakan->jenis_pakan }}" placeholder="Jenis Pakan" class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-base border-0 shadow outline-none focus:outline-none focus:ring w-full" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-3 border-t border-solid border-blueGray-200 rounded-b">
                            <button class="text-gray-500 background-transparent font-bold px-6 py-2 text-base outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" onclick="history.back()">
                                Cancel
                            </button>
                            <button type="submit" class="focus:ring-2 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-primary hover:bg-primary focus:outline-none rounded">
                                <p class="text-base font-semibold leading-none text-white">Update Data</p>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
