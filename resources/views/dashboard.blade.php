<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Hero Section with Background Image -->
    <div class="py-12">
        <div class="min-h-screen bg-no-repeat bg-center bg-cover flex items-center justify-center text-white" 
             style="background-image: url('/images/dashboard.jpg'); background-color: #1e40af;">
            <!-- Semi-transparent Overlay -->
            <div class="bg-black bg-opacity-50 p-3 rounded-lg text-center max-w-5xl h-2xl">
                <h1 class="text-3xl font-bold mb-8">Welcome to Your Dashboard</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <a href="/resume-builder" class="bg-white p-6 rounded-lg shadow-lg text-center hover:bg-gray-100">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Resume Builder</h3>
                        <p class="text-gray-700">Optimize your resume with AI suggestions.</p>
                    </a>
                    <a href="/cover-letter-generator" class="bg-white p-6 rounded-lg shadow-lg text-center hover:bg-gray-100">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Cover Letter Generator</h3>
                        <p class="text-gray-700">Generate personalized cover letters for any job.</p>
                    </a>
                    <a href="/interview-simulation" class="bg-white p-6 rounded-lg shadow-lg text-center hover:bg-gray-100">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Interview Simulation</h3>
                        <p class="text-gray-700">Practice mock interviews and get feedback.</p>
                    </a>
                    <a href="/analytics-dashboard" class="bg-white p-6 rounded-lg shadow-lg text-center hover:bg-gray-100">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Analytics Dashboard</h3>
                        <p class="text-gray-700">View insights on common resume errors and interview trends.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>