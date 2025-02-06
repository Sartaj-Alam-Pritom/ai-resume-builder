<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cover Letter Generator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center mb-8">Cover Letter Generator</h1>

                    <!-- Validation Errors -->
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Form -->
                    <form action="/cover-letter/generate" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="job_title" class="block text-sm font-medium text-gray-700">Job Title</label>
                            <input type="text" name="job_title" id="job_title" value="{{ old('job_title') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="job_description" class="block text-sm font-medium text-gray-700">Job Description</label>
                            <textarea name="job_description" id="job_description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('job_description') }}</textarea>
                        </div>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Generate Cover Letter</button>
                    </form>

                    <!-- Display Generated Cover Letter -->
                    @if(isset($coverLetter))
                    <div class="mt-8">
                        <h2 class="text-xl font-bold">Generated Cover Letter:</h2>
                        <div class="bg-gray-100 p-4 rounded-md mt-2">
                            <p>{{ $coverLetter }}</p>
                        </div>
                        <!-- Save Button -->
                        @auth
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4" onclick="saveCoverLetter()">Save Cover Letter</button>
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Save Functionality -->
    <script>
        function saveCoverLetter() {
            alert("Cover letter saved successfully!");
            // You can implement an AJAX call here to save the cover letter asynchronously.
            // Example:
            /*
            fetch('/save-cover-letter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    job_title: document.getElementById('job_title').value,
                    company_name: document.getElementById('company_name').value,
                    job_description: document.getElementById('job_description').value,
                    cover_letter: `{{ addslashes($coverLetter ?? '') }}`
                })
            }).then(response => {
                if (response.ok) {
                    alert("Cover letter saved successfully!");
                } else {
                    alert("Failed to save cover letter. Please try again.");
                }
            });
            */
        }
    </script>
</x-app-layout>