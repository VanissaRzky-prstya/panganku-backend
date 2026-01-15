<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>panganku</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-green-700 text-white">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="font-bold text-xl">PANGANKU</div>
            <ul class="flex space-x-6">
                <li><a href="#" class="hover:underline">Beranda</a></li>
                <li><a href="#" class="hover:underline">Keranjang</a></li>
                <li><a href="#" class="hover:underline">Transaksi</a></li>
                <li><a href="/account" class="hover:underline">Akun Saya</a></li>
            </ul>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
    </main>
    <footer class="bg-green-700 text-white mt-12">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center">PANGANKU | Bahan segar keluarga sehat</div>
    </footer>
</body>
</html>

