<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panganku</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-green-700 text-white">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="font-bold text-xl">PANGANKU</div>
            <ul class="flex gap-6 items-center">
                <li><a href="/home" class="hover:underline">Beranda</a></li>
                <li class="relative">
                    <a href="/keranjang" class="hover:underline flex items-center gap-1">Keranjang<span id="cart-badge" class="hidden absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">0</span>
                    </a>
                </li>
                <li><a href="/transaksi" class="hover:underline">Transaksi</a></li>
                <li class="relative group">
                    <a href="/akun" class="font-semibold hover:underline">Akun Saya</a>
                    <div class="absolute right-0 mt-2 w-56 bg-white text-black rounded shadow-lg hidden group-hover:block z-50">
                        <div class="px-4 py-3 border-b">
                            <p class="font-semibold">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="/logout">
                            @csrf 
                            <button type="submit" class="text-red-600 w-full text-left hover:underline">Logout</button>
                        </form>
                    </div>
                </li> 
            </ul>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-10 w-full flex-1">
        @yield('content')
    </main>

    <footer class="bg-green-700 text-white">
        <div class="max-w-7xl mx-auto px-6 py-4 text-center">PANGANKU | Bahan segar keluarga sehat</div>
    </footer>
    @yield('scripts')
</body>
</html>

