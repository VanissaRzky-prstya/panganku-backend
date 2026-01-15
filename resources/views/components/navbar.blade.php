<nav class="bg-green-700 text-white">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">
        <h1 class="text-xl font-bold">PANGANKU</h1>
        <ul class="flex gap-6 items-center">
            <li><a href="/home" class="hover:underline">Beranda</a></li>
            <li><a href="#" class="hover:underline">Keranjang</a></li>
            <li><a href="#" class="hover:underline">Transaksi</a></li>
            <li class="relative group">
                <span class="cursor-pointer">Akun ▾</span>
                <div class="absolute hidden group-hover:block bg-white text-black right-0 mt-2 rounded shadow w-40">
                    <div class="px-4 py-2 text-sm">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs">{{ auth()->user()->email }}</p>
                    </div>
                    <hr>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
