
<aside class="flex flex-col w-3/12 bg-white shadow-md rounded-l-3xl items-center left-0 @if($active != 'Dashboard' && $data >= 2) h-auto @else h-screen @endif z-20 px-3">
    <div class="fixed w-[150px]">
        <div class="flex items-center justify-center flex-col mt-12 mb-20 mx-auto rounded-2xl">
            <img src="{{ asset('assets/images/sheep.png') }}" alt="Sheep Image" class="w-20 h-20">
            <p class="text-center font-normal leading-[100%] text-gray-400 mt-2 text-sm">Sistem Pendukung Keputusan Pakan Domba TOPSIS</p>
        </div>
        <nav class="relative flex flex-col pb-4 -mt-12 fixed items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-start p-3 w-40 h-16 border @if($active == 'Dashboard') text-primary @else text-gray-700 @endif rounded-2xl mb-4 hover:text-primary duration-700">
                <i class='bx bxs-grid-alt text-3xl mr-2'></i>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('kriteria') }}" class="flex items-center justify-start p-3 w-40 h-16 border @if($active == 'Kriteria') text-primary @else text-gray-700 @endif rounded-2xl mb-4 hover:text-primary duration-700">
                <i class="bx bxs-purchase-tag-alt text-3xl mr-2"></i>
                <span class="text-sm">Kriteria</span>
            </a>
            <a href="{{ route('bobot') }}" class="flex items-center justify-start p-3 w-40 h-16 border @if($active == 'Bobot') text-primary @else text-gray-700 @endif rounded-2xl mb-4 hover:text-primary duration-700">
                <i class='bx bxs-layer text-3xl mr-2'></i>
                <span class="text-sm">Bobot</span>
            </a>
            <a href="{{ route('pakan') }}" class="flex items-center justify-start p-3 w-40 h-16 border @if($active == 'Pakan Domba') text-primary @else text-gray-700 @endif rounded-2xl mb-4 hover:text-primary duration-700">
                <i class="bx bxs-bowl-rice text-3xl mr-2"></i>
                <span class="text-sm">Pakan</span>
            </a>
            <a href="{{ route('penilaian') }}" class="flex items-center justify-start p-3 w-40 h-16 border @if($active == 'Penilaian') text-primary @else text-gray-700 @endif rounded-2xl mb-4 hover:text-primary duration-700">
                <i class='bx bxs-star text-3xl mr-2'></i>
                <span class="text-sm">Penilaian</span>
            </a>
            <form action="{{ route('process.logout') }}" method="post">
                @csrf
                <button class="flex items-center justify-start p-3 w-40 h-16 border text-gray-700 rounded-2xl mb-4 hover:text-primary duration-700">
                    <i class='bx bxs-log-out-circle text-3xl mr-2'></i>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </nav>
    </div>
</aside>