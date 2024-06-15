@extends('layouts.main', [
'title' => 'Login',
'active' => 'Login'
])

@section('content')
<section class="w-full mx-auto flex md:flex-row flex-col items-center justify-center h-full md:h-screen body relative">
    <div class="w-full fixed px-16 py-5 top-0 bg-white flex justify-between items-center">
        <div class="flex gap-2 items-center">
            <img src="{{ asset('assets/images/sheep.png') }}" alt="Sheep Icon" class="w-12 h-12 text-primary tracking-[-2px]">
            <h2 class="text-left text-2xl text-primary tracking-[-2px] font-bold">Sistem Pendukung Keputusan Metode TOPSIS</h2>
        </div>

        <a href="{{ route('user') }}" class="bg-primary text-white px-5 py-2 rounded-full text-lg font-medium"><i class='bx bxs-pencil mr-2'></i>Lakukan Penilaian Alternatif</a>
    </div>
    <div class="flex flex-1 flex-col  items-start mt-8 md:mt-0 justify-center h-screen p-16 gap-5">
        <h2 class="text-left text-3xl text-white font-bold">Sistem Pendukung Keputusan Metode TOPSIS</h2>
        <p class="text-white text-justify">Sistem Pendukung Keputusan (SPK) merupakan suatu sistem informasi spesifik yang ditujukan untuk membantu manajemen dalam mengambil keputusan yang berkatian dengan persoalan yang bersifat semi terstruktur.</p>

        <p class="text-white text-justify">Metode Technique for Order Preference by Similarity to Ideal Solution (TOPSIS) adalah suatu metode dari model keputusan Multi Attribute Decision Making (MADM). Metode TOPSIS menggunakan konsep dimana alternatif terpilih yang terbaik tidak hanya memiliki jarak terpendek dari solusi ideal positif, tetapi juga memiliki jarak terpanjang dari solusi ideal negatif.</p>
    </div>
    <div class="flex flex-col mr-10 w-fit justify-center bg-white rounded-xl p-10 w-[40%] box">
        <div class="flex flex-col gap-5 md:mr-0">
            {{-- HEADER WELCOME --}}
            <div class="flex gap-2 items-center">
                <img src="{{ asset('assets/images/sheep.png') }}" alt="Sheep Icon" class="w-16 h-16 text-primary">
                <div class="flex flex-col">
                    <h5 class="text-base text-dark-secunder">Welcome back! 👋🏻</h5>
                    <h3 class="text-xl text-dark font-medium">
                        Login ke Dashboard SPK <br />Pakan Domba
                    </h3>
                </div>
            </div>

            {{-- FORM LOGIN --}}
            <form action="{{ route('process.login') }}" method="POST" class="flex flex-col gap-3 text-base ">
                @csrf
                {{-- USERNAME INPUT --}}
                <div class="flex flex-col gap-1">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="@error('password')  border-red-500 @else border-dark @enderror border rounded-md p-2 border-gray-300">
                    @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- PASSWORD INPUT --}}
                <div class="flex flex-col gap-1 w-full">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="@error('password')  border-red-500 @else border-dark @enderror border rounded-md p-2 border-gray-300 ">
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- BUTTON LOGIN --}}
                <button type="submit" class="p-3 bg-primary rounded-md text-white font-semibold text-center">Login</button>
            </form>
        </div>
    </div>
</section>

@endsection