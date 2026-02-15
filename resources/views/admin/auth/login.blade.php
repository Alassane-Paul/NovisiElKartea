<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Novisi Elkartea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Novisi Elkartea" class="h-16 mx-auto mb-4 object-contain">
            <h1 class="text-2xl font-bold text-teal-700">Administration</h1>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-teal-500"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-blue-500">
                    <span class="ml-2 text-gray-600 text-sm">Se souvenir de moi</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 focus:outline-none focus:bg-orange-600 transition duration-150">
                Se connecter
            </button>
            
            <div class="mt-4 text-center">
                <a href="{{ route('admin.register') }}" class="text-sm text-teal-600 hover:text-teal-800">S'inscrire comme administrateur</a>
            </div>
        </form>
    </div>
</body>
</html>
