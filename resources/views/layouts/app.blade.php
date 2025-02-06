<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AI Resume Builder') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased dark:bg-gray-900">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navigation Menu -->
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('resume.builder')" :active="request()->routeIs('resume.builder')">
                                {{ __('Resume Builder') }}
                            </x-nav-link>
                            <x-nav-link :href="route('cover.letter.generator')" :active="request()->routeIs('cover.letter.generator')">
                                {{ __('Cover Letter Generator') }}
                            </x-nav-link>
                            <x-nav-link :href="route('interview.simulation')" :active="request()->routeIs('interview.simulation')">
                                {{ __('Interview Simulation') }}
                            </x-nav-link>
                            <x-nav-link :href="route('analytics.dashboard')" :active="request()->routeIs('analytics.dashboard')">
                                {{ __('Analytics Dashboard') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- User Dropdown or Guest Links -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @if (Auth::check())
                            <!-- User Dropdown for Authenticated Users -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <!-- Guest Links -->
                            <div class="space-x-4">
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-400 underline hover:text-gray-900 dark:hover:text-gray-100">
                                    Log In
                                </a>
                                <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-400 underline hover:text-gray-900 dark:hover:text-gray-100">
                                    Register
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>