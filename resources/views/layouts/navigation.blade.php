<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="text-xl font-bold text-blue-600 dark:text-white">AI Resume Builder</a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                @auth
                    <x-nav-link :href="route('resume.builder')" :active="request()->routeIs('resume.builder')">Resume Builder</x-nav-link>
                    <x-nav-link :href="route('cover.letter.generator')" :active="request()->routeIs('cover.letter.generator')">Cover Letter Generator</x-nav-link>
                    <x-nav-link :href="route('interview.simulation')" :active="request()->routeIs('interview.simulation')">Interview Simulation</x-nav-link>
                    <x-nav-link :href="route('analytics.dashboard')" :active="request()->routeIs('analytics.dashboard')">Analytics Dashboard</x-nav-link>
                @endauth
            </div>

            <!-- Authentication Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <!-- Account Settings Dropdown -->
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
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Logout</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endauth
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('resume.builder')" :active="request()->routeIs('resume.builder')">Resume Builder</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cover.letter.generator')" :active="request()->routeIs('cover.letter.generator')">Cover Letter Generator</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('interview.simulation')" :active="request()->routeIs('interview.simulation')">Interview Simulation</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('analytics.dashboard')" :active="request()->routeIs('analytics.dashboard')">Analytics Dashboard</x-responsive-nav-link>
            @endauth
        </div>

        <!-- Authentication Links -->
        <div class="border-t border-gray-200 dark:border-gray-600 pt-4 pb-1">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Logout</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <x-responsive-nav-link :href="route('login')">Log in</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>