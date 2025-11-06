<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - IMXScore</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .login-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased login-bg">
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full">
                <!-- Login Form Card -->
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Logo Header Inside Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-6 py-6 text-center">
                        <div class="flex justify-center items-center space-x-6 mb-4">
                            <!-- Logo ILS.png -->
                            <div class="text-center">
                                <div class="bg-white/20 w-14 h-14 rounded-lg flex items-center justify-center mx-auto backdrop-blur-sm">
                                    <img src="{{ asset('images/ILS.png') }}" alt="Logo ILS" class="w-10 h-10 object-contain">
                                </div>
                            </div>

                            <!-- Logo smp.png -->
                            <div class="text-center">
                                <div class="bg-white/20 w-14 h-14 rounded-lg flex items-center justify-center mx-auto backdrop-blur-sm">
                                    <img src="{{ asset('images/smp.png') }}" alt="Logo SMP" class="w-10 h-10 object-contain">
                                </div>
                            </div>
                        </div>

                        <!-- System Title -->
                        <div class="text-white">
                            <h1 class="text-2xl font-bold mb-1">IMXScore</h1>
                            <p class="text-blue-100 text-sm">Islamic Muhammadiyah Excellence Score System</p>
                        </div>
                    </div>

                    <div class="px-6 py-6">
                        <!-- Welcome Message -->
                        <div class="text-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">بِسْمِ اللهِ الرحمن الرَّحِيْمِ</h2>
                            <p class="text-gray-600 text-sm">Silakan masuk ke akun Anda</p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 p-3 bg-green-50 rounded-lg border border-green-200 text-sm" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input id="email" 
                                           type="email" 
                                           name="email" 
                                           :value="old('email')" 
                                           required 
                                           autofocus 
                                           autocomplete="username"
                                           class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                           placeholder="juru@kejoedscore.com">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input id="password" 
                                           type="password" 
                                           name="password" 
                                           required 
                                           autocomplete="current-password"
                                           class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                           placeholder="Masukkan password">
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between mb-6">
                                <label class="flex items-center">
                                    <input id="remember_me" 
                                           type="checkbox" 
                                           name="remember" 
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-600 hover:text-blue-500 font-medium" href="{{ route('password.request') }}">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold shadow-md hover:shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk ke Sistem
                            </button>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="text-center text-sm text-gray-500">
                            &copy; {{ date('Y') }} IMXScore. All rights reserved.
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                {{-- <div class="text-center mt-4">
                    <p class="text-sm text-white">
                        Butuh bantuan? 
                        <a href="#" class="font-medium text-white hover:text-blue-200 underline">
                            Hubungi administrator
                        </a>
                    </p>
                </div> --}}
            </div>
        </div>

        <script>
            // Simple animation on load
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                form.classList.add('animate-fade-in');
            });
        </script>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.6s ease-out;
            }
        </style>
    </body>
</html>