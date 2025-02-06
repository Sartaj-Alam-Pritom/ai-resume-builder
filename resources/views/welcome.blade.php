<!-- resources/views/welcome.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <!-- Hero Section with Full-Screen Background Image -->
    <div class="py-12">
        <div class="min-h-screen bg-no-repeat bg-center bg-cover flex items-center justify-center text-white" 
             style="background-image: url('/images/welcome.jpg'); background-color: #1e40af;">
            <!-- Semi-transparent Overlay -->
            <div class="bg-black bg-opacity-50 p-8 rounded-lg text-center max-w-3xl">
                <h1 class="text-4xl font-bold mb-4">Build Your Career with AI</h1>
                <p class="text-xl mb-8">Optimize resumes, generate cover letters, and ace interviews with our AI-powered tools.</p>
                <a href="/resume-builder" class="bg-white text-blue-600 px-6 py-3 rounded-md font-semibold hover:bg-gray-200 transition duration-300 ease-in-out">Get Started</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold mb-4">Smart Resume Builder</h3>
                <p>Automatically optimize your resume for the Bangladeshi job market.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold mb-4">Cover Letter Generator</h3>
                <p>Create personalized cover letters tailored to any job description.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold mb-4">Interview Simulation</h3>
                <p>Practice mock interviews with real-time feedback on performance.</p>
            </div>
        </div>
    </div>
</x-app-layout>