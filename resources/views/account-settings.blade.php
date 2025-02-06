<!-- resources/views/account-settings.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center mb-8">Account Settings</h1>
                    <form action="/update-account" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>