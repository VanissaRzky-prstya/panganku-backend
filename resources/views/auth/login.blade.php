<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-300"required>
            </div>
            <div class="mb-2">
                <label class="block mb-1 font-semibold">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-300"required>
            </div>
            <div class="text-right text-sm mb-4">
                <a href="#" class="text-green-500 hover:underline">Lupa password?</a>
            </div>
            <button type="submit"class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Login</button>
        </form>
        <p class="text-center text-sm mt-4">Belum punya akun?<a href="/register" class="text-green-500 hover:underline">Daftar</a></p>
    </div>    
</body>
</html>