<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Inscription - Novisi Elkartea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Novisi Elkartea" class="h-16 mx-auto mb-4 object-contain">
            <h1 class="text-2xl font-bold text-teal-700">Inscription Admin</h1>
        </div>

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nom</label>
                <input type="text" name="name" id="name" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-teal-500"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-teal-500"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Mot de passe</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-teal-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-teal-500">
            </div>

            <button type="submit"
                class="w-full bg-teal-600 text-white font-bold py-2 px-4 rounded hover:bg-teal-700 focus:outline-none focus:bg-teal-700 transition duration-150">
                S'inscrire
            </button>
            
            <div class="mt-4 text-center">
                <a href="{{ route('admin.login') }}" class="text-sm text-teal-600 hover:text-teal-800">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </div>
</body>
</html>
