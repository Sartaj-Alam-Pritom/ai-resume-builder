<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Analytics Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center mb-8">Analytics Dashboard</h1>

                    <!-- Export Button -->
                    <div class="mb-8 text-right">
                        <a href="/export-analytics" class="bg-green-500 text-white px-4 py-2 rounded-md">Export Data</a>
                    </div>

                    <!-- Resume Errors Chart -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Common Resume Errors</h2>
                        <canvas id="resumeErrorsChart" width="400" height="200"></canvas>
                    </div>

                    <!-- Interview Performance Metrics -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Interview Performance</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-100 p-4 rounded-md">
                                <p class="text-lg font-semibold">Average Confidence Score:</p>
                                <p class="text-xl">{{ number_format($interviewPerformance->avg_confidence ?? 0, 2) }}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-md">
                                <p class="text-lg font-semibold">Average Clarity Score:</p>
                                <p class="text-xl">{{ number_format($interviewPerformance->avg_clarity ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- User Activity Trends -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">User Activity Trends</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-100 p-4 rounded-md text-center">
                                <p class="text-lg font-semibold">Resumes Generated</p>
                                <p class="text-xl">{{ $userActivity['resumes_generated'] }}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-md text-center">
                                <p class="text-lg font-semibold">Cover Letters Generated</p>
                                <p class="text-xl">{{ $userActivity['cover_letters_generated'] }}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-md text-center">
                                <p class="text-lg font-semibold">Interviews Simulated</p>
                                <p class="text-xl">{{ $userActivity['interviews_simulated'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('resumeErrorsChart').getContext('2d');
        const resumeErrorsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($resumeErrors)),
                datasets: [{
                    label: 'Common Resume Errors',
                    data: @json(array_values($resumeErrors)),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</x-app-layout>