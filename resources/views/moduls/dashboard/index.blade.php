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
    <div ss="flex flex-col w-full w-12/12">
        <div class="sm:px-6 w-full">
            <div class="px-4 md:px-10 py-4 md:pt-12 md:pb-7">
                <div class="flex items-center justify-between">
                    <p tabindex="0" class="focus:outline-none text-base sm:text-lg md:text-2xl lg:text-3xl font-bold leading-normal text-gray-800">
                        Dashboard Sistem Pendukung <br>Keputusan Pakan Domba </p>
                </div>
            </div>
            <div class="flex w-full gap-2 px-10">
                <div class="flex items-center justify-center p-3 w-fit h-fit border  text-primary text-gray-700 rounded-2xl mb-4 gap-3">
                    <i class="bx bxs-purchase-tag-alt text-3xl"></i>
                    <div class="flex flex-col gap-1">
                        <p class="text-gray-500 font-normal text-sm">Kriteria</p>
                        <p class="text-black font-bold text-3xl -mt-2">{{$kriterias}}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center p-3 w-fit h-fit border  text-primary text-gray-700 rounded-2xl mb-4 gap-3">
                    <i class='bx bxs-layer text-3xl'></i>
                    <div class="flex flex-col gap-1">
                        <p class="text-gray-500 font-normal text-sm">Bobot</p>
                        <p class="text-black font-bold text-3xl -mt-2">{{$bobots}}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center p-3 w-fit h-fit border text-primary text-gray-700 rounded-2xl mb-4 gap-3">
                    <i class="bx bxs-bowl-rice text-3xl"></i>
                    <div class="flex flex-col gap-1">
                        <p class="text-gray-500 font-normal text-sm">Pakan</p>
                        <p class="text-black font-bold text-3xl -mt-2">{{$pakans}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection