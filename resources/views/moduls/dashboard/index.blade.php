@extends('layouts.main', [
    'title' => 'Dashboard',
    'active' => 'Dashboard'
])

@section('content')
<section class="flex w-full fixed">
    @include('moduls.dashboard.layouts.sidebar', [
        'active' => 'Dashboard',
        'data' => 0,
    ])
    <div class="flex flex-col w-full w-12/12">
        <div class="sm:px-6 w-full">
            <div class="px-4 md:px-10 py-4 md:pt-12 md:pb-7">
                <div class="flex items-center justify-between">
                    <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-2xl lg:text-3xl font-bold leading-normal text-gray-800">
                        Dashboard Sistem Pendukung <br>Keputusan Pakan Domba
                    </p>
                </div>
            </div>
            <div class="flex w-full gap-4 px-10">
                <div class="flex items-center justify-center p-4 w-fit h-fit border border-gray-300 shadow-lg rounded-2xl bg-white text-primary text-gray-700 mb-4 gap-4">
                    <i class="bx bxs-purchase-tag-alt text-4xl"></i>
                    <div class="flex flex-col">
                        <p class="text-gray-500 font-medium text-sm">Kriteria</p>
                        <p class="text-black font-bold text-4xl">{{$kriterias}}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 w-fit h-fit border border-gray-300 shadow-lg rounded-2xl bg-white text-primary text-gray-700 mb-4 gap-4">
                    <i class='bx bxs-layer text-4xl'></i>
                    <div class="flex flex-col">
                        <p class="text-gray-500 font-medium text-sm">Bobot</p>
                        <p class="text-black font-bold text-4xl">{{$bobots}}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 w-fit h-fit border border-gray-300 shadow-lg rounded-2xl bg-white text-primary text-gray-700 mb-4 gap-4">
                    <i class="bx bxs-bowl-rice text-4xl"></i>
                    <div class="flex flex-col">
                        <p class="text-gray-500 font-medium text-sm">Pakan</p>
                        <p class="text-black font-bold text-4xl">{{$pakans}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
