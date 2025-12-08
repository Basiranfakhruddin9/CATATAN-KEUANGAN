<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        @section('content')

        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                Selamat Datang
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Masuk ke akun Anda atau buat akun baru
            </p>
        </div>

        <!-- Tab Navigation -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="flex">
                <button id="login-tab" class="flex-1 py-4 px-6 text-center font-medium transition-all duration-300 bg-blue-600 text-white rounded-t-2xl">
                    Masuk
                </button>
                <button id="register-tab" class="flex-1 py-4 px-6 text-center font-medium transition-all duration-300 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    Daftar
                </button>
            </div>

            <!-- Login Form -->
            <div id="login-form" class="p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                                placeholder="Masukkan email Anda">
                            <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                                placeholder="Masukkan kata sandi">
                            <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                Ingat saya
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-105 active:scale-95">
                        <span class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" id="login-spinner" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Masuk
                        </span>
                    </button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="p-8 hidden">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                                placeholder="Masukkan nama lengkap">
                            <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="register-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <input id="register-email" name="email" type="email" autocomplete="email" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                                placeholder="Masukkan email Anda">
                            <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="register-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input id="register-password" name="password" type="password" autocomplete="new-password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                                placeholder="Minimal 8 karakter">
                            <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Konfirmasi Kata Sandi
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                                placeholder="Konfirmasi kata sandi">
                            <svg class="absolute right-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform transition-all duration-200 hover:scale-105 active:scale-95">
                        <span class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" id="register-spinner" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Daftar
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Dengan masuk, Anda menyetujui
                <a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">Syarat & Ketentuan</a>
                dan
                <a href="#" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">Kebijakan Privasi</a>
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    loginTab.addEventListener('click', function() {
        loginTab.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');
        loginTab.classList.add('bg-blue-600', 'text-white');
        registerTab.classList.remove('bg-blue-600', 'text-white');
        registerTab.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');

        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
    });

    registerTab.addEventListener('click', function() {
        registerTab.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');
        registerTab.classList.add('bg-blue-600', 'text-white');
        loginTab.classList.remove('bg-blue-600', 'text-white');
        loginTab.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-gray-900', 'dark:hover:text-white');

        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
    });

    // Form submission loading states
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const button = form.querySelector('button[type="submit"]');
            const spinner = button.querySelector('.animate-spin');
            const text = button.querySelector('span:not(.animate-spin)');

            spinner.classList.remove('hidden');
            button.disabled = true;
            text.textContent = 'Memproses...';
        });
    });
});
</script>
@endsection
