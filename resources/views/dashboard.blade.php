@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -inset-10 opacity-20">
            <div class="absolute w-72 h-72 bg-purple-500 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute w-72 h-72 bg-blue-500 rounded-full blur-3xl bottom-0 right-0 animate-pulse delay-1000"></div>
        </div>
    </div>

    <!-- Header -->
    <header class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">
                        {{ __('Dashboard') }}
                    </h1>
                    <p class="text-gray-400">Welcome to your command center</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-3 h-3 bg-green-400 rounded-full animate-ping"></div>
                    <span class="text-green-400 text-sm">Live</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Welcome Card -->
            <div class="bg-gray-800/50 backdrop-blur-xl rounded-3xl border border-gray-700 p-8 mb-8 transform hover:scale-[1.02] transition-all duration-300">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">Authentication Successful!</h2>
                    <div class="bg-gray-700/50 rounded-2xl p-6 border border-gray-600 max-w-md mx-auto">
                        <p class="text-xl text-gray-300 font-medium">
                            {{ __("You're logged in!") }}
                        </p>
                    </div>
                    <div class="flex justify-center space-x-4 mt-8">
                        <button class="px-8 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-2xl font-bold shadow-2xl hover:shadow-cyan-500/25 transition-all duration-300 hover:-translate-y-1">
                            Launch Console
                        </button>
                        <button class="px-8 py-3 border border-gray-600 text-gray-300 rounded-2xl font-bold hover:bg-gray-700/50 transition-all duration-300">
                            Settings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Session Card -->
                <div class="bg-gray-800/50 backdrop-blur-xl rounded-2xl border border-gray-700 p-6 hover:border-cyan-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 text-sm font-semibold">ACTIVE SESSION</h3>
                        <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                    </div>
                    <p class="text-2xl font-bold text-white">Current</p>
                    <p class="text-gray-400 text-sm mt-2">Started just now</p>
                </div>

                <!-- Security Card -->
                <div class="bg-gray-800/50 backdrop-blur-xl rounded-2xl border border-gray-700 p-6 hover:border-green-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 text-sm font-semibold">SECURITY</h3>
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">Protected</p>
                    <p class="text-gray-400 text-sm mt-2">All systems secure</p>
                </div>

                <!-- Status Card -->
                <div class="bg-gray-800/50 backdrop-blur-xl rounded-2xl border border-gray-700 p-6 hover:border-blue-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 text-sm font-semibold">SYSTEM STATUS</h3>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        </div>
                    </div>
                    <p class="text-2xl font-bold text-white">Optimal</p>
                    <p class="text-gray-400 text-sm mt-2">All services running</p>
                </div>

                <!-- Performance Card -->
                <div class="bg-gray-800/50 backdrop-blur-xl rounded-2xl border border-gray-700 p-6 hover:border-purple-500/50 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 text-sm font-semibold">PERFORMANCE</h3>
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-white">100%</p>
                    <p class="text-gray-400 text-sm mt-2">System ready</p>
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="mt-8 bg-gray-800/50 backdrop-blur-xl rounded-2xl border border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Recent Activity</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 p-3 bg-gray-700/30 rounded-xl">
                        <div class="w-2 h-2 bg-cyan-400 rounded-full"></div>
                        <span class="text-gray-300">User authentication completed</span>
                        <span class="text-gray-500 text-sm ml-auto">Just now</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-700/30 rounded-xl">
                        <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                        <span class="text-gray-300">Session initialized</span>
                        <span class="text-gray-500 text-sm ml-auto">Just now</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-700/30 rounded-xl">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span class="text-gray-300">Dashboard accessed</span>
                        <span class="text-gray-500 text-sm ml-auto">Just now</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection