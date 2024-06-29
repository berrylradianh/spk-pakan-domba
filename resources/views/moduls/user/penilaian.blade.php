@extends('layouts.main', [
    'title' => 'Login',
    'active' => 'Login',
])

@section('content')
    <script>
        function validateForm() {
            const checkboxes_admin = document.querySelectorAll('input[name="selected_penilaians[]"]:checked');
            const checkboxes_user = document.querySelectorAll('input[name="selected_penilaian_users[]"]:checked');
            const checkboxes = checkboxes_admin.length + checkboxes_user.length
            if (checkboxes == 0) {
                alert('Harap pilih alternatif terlebih dahulu');
                return false;
            } else if (checkboxes == 1) {
                alert('Harap pilih lebih dari satu alternatif');
                return false;
            }
            return true;
        }
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
                                class="focus:outline-none text-base sm:text-lg md:text-2xl text-white lg:text-3xl font-bold leading-normal text-gray-800 mt-2 mb-5">
                                PENILAIAN</p>
                            <p class="text-gray-400 max-w-2xl">&nbsp;</p>
                        </div>
                    </div>
                </div>

                {{-- @if (sizeof($penilaians) > 2) --}}

                <form action="{{ route('generateRanking') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="w-full flex flex-col gap-3 mb-1">
                            <div class="flex gap-2 w-full items-center">
                                <i class='bx bxs-select-multiple text-3xl text-primary'></i>
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Penilaian Admin
                                </h2>
                            </div>
                            @if (sizeof($penilaians) == 0)
                                <div
                                    class="w-full text-gray-500 flex flex-col items-center justify-center max-w-md text-center mx-auto mt-10">

                                    <img src="https://static.vecteezy.com/system/resources/previews/034/795/880/original/ai-generated-cute-sheep-cartoon-image-free-png.png"
                                        alt="" class="w-48">
                                    <h3 class="text-primary font-bold text-5xl mt-2">Oops!</h3>

                                    <p>Data Penilaian Kosong! Silahkan tambah data penilaian</p>
                                </div>
                            @else
                                <div class="w-full grid grid-cols-2 mb-1 gap-3">
                                    @foreach ($penilaians as $penilaian)
                                        <div class="flex items-center ps-4 box rounded-lg bg-white">

                                            <input id="{{ $penilaian->id }}" type="checkbox" value="{{ $penilaian->id }}"
                                                name="selected_penilaians[]" class="w-4 h-4 text-blue-600 bg-gray-100">
                                            <label for="{{ $penilaian->id }}"
                                                class="w-full py-4 ms-2 text-base font-medium text-black">{{ $penilaian->jenis_pakan }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div
                                        class="sm:flex items
                                       -center justify-start gap-2">
                                        <button type="submit"
                                            class="focus:ring-2 focus:ring-offset-2 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-1 bg-primary hover:bg-primary focus:outline-none rounded">
                                            <p class="font-semibold leading-none text-white flex items-center gap-1">
                                                <i class='bx bxs-bar-chart-alt-2 text-lg'></i>
                                                <span>Generate Ranking</span>
                                            </p>
                                        </button>
                                    </div> --}}
                                {{-- </form> --}}
                            @endif



                        </div>


                    </div>


                    {{-- @endif --}}

                    {{-- @if (sizeof($penilaians) > 2) --}}

                    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mr-16 w-full max-w-full min-w-full">
                        <div class="w-full flex flex-col gap-3 mb-10">
                            <div class="flex gap-2 w-full items-center">
                                <i class='bx bxs-select-multiple text-3xl text-primary'></i>
                                <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Penilaian User
                                </h2>
                            </div>
                            @if (sizeof($penilaian_users) == 0)
                                <div
                                    class="w-full text-gray-500 flex flex-col items-center justify-center max-w-md text-center mx-auto mt-10">

                                    <img src="https://static.vecteezy.com/system/resources/previews/034/795/880/original/ai-generated-cute-sheep-cartoon-image-free-png.png"
                                        alt="" class="w-48">
                                    <h3 class="text-primary font-bold text-5xl mt-2">Oops!</h3>

                                    <p>Data Penilaian Kosong! Silahkan tambah data penilaian</p>
                                </div>
                            @else
                                {{-- <form action="{{ route('generateRanking') }}" method="POST"
                                    onsubmit="return validateForm()"> --}}
                                {{-- @csrf --}}
                                <div class="w-full grid grid-cols-2 mb-5 gap-3">
                                    @foreach ($penilaian_users as $penilaian)
                                        <div class="flex items-center ps-4 box rounded-lg bg-white">

                                            <input id="{{ $penilaian->id }}" type="checkbox" value="{{ $penilaian->id }}"
                                                name="selected_penilaian_users[]" class="w-4 h-4 text-blue-600 bg-gray-100">
                                            <label for="{{ $penilaian->id }}"
                                                class="w-full py-4 ms-2 text-base font-medium text-black">{{ $penilaian->jenis_pakan }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="sm:flex items
                                   -center justify-start gap-2">
                                    <button type="submit"
                                        class="focus:ring-2 focus:ring-offset-2 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-1 bg-primary hover:bg-primary focus:outline-none rounded">
                                        <p class="font-semibold leading-none text-white flex items-center gap-1">
                                            <i class='bx bxs-bar-chart-alt-2 text-lg'></i>
                                            <span>Generate Ranking</span>
                                        </p>
                                    </button>
                                </div>
                                {{-- </form> --}}
                            @endif



                        </div>


                    </div>
                </form>


                {{-- @endif --}}
            </div>
        </div>
    </section>


@endsection
