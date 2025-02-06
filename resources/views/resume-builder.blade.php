<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resume Builder') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center mb-8">Smart Resume Builder</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column: Form -->
                        <form action="/resume/optimize" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $name ?? '' }}">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ $email ?? '' }}">
                            </div>
                            <div>
                                <label for="experience" class="block text-sm font-medium text-gray-700">Work Experience</label>
                                <textarea name="experience" id="experience" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $experience ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Optimize Resume</button>
                        </form>
                        <!-- Right Column: Live Preview -->
                        <div class="border p-4 rounded-lg shadow-lg">
                            <h2 class="text-xl font-bold mb-4">Live Preview</h2>
                            <div id="resume-preview" class="space-y-2">
                                <h3 class="text-lg font-semibold">Name: <span id="preview-name">{{ $name ?? 'Your Name' }}</span></h3>
                                <p>Email: <span id="preview-email">{{ $email ?? 'Your Email' }}</span></p>
                                <p>Experience: <span id="preview-experience">{{ $experience ?? 'Your Experience' }}</span></p>
                            </div>
                            <!-- Display Optimized Content -->
                            @if(isset($optimizedContent))
                            <div class="mt-4">
                                <h2 class="text-xl font-bold">Optimized Resume:</h2>
                                <p>{{ $optimizedContent }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>