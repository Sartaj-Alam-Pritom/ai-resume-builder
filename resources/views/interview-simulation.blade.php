<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Interview Simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center mb-8">Interview Simulation</h1>
                    <div class="space-y-4">
                        @foreach ($questions as $index => $question)
                        <div>
                            <h2 class="text-xl font-semibold">Question {{ $index + 1 }}:</h2>
                            <p>{{ $question }}</p>
                            <button id="start-recording-{{ $index }}" class="bg-red-500 text-white px-4 py-2 rounded-md mt-2">Start Recording</button>
                            <button id="save-recording-{{ $index }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 ml-2" style="display: none;">Save Recording</button>
                            <audio id="audio-preview-{{ $index }}" controls style="display: none;"></audio>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let mediaRecorder;
        const audioChunks = [];
        document.querySelectorAll('[id^="start-recording"]').forEach((button, index) => {
            button.addEventListener('click', async () => {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.ondataavailable = event => {
                    audioChunks.push(event.data);
                };
                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                    const audioUrl = URL.createObjectURL(audioBlob);

                    // Display the audio preview
                    const audioPreview = document.getElementById(`audio-preview-${index}`);
                    audioPreview.src = audioUrl;
                    audioPreview.style.display = 'block';

                    // Show the Save button
                    document.getElementById(`save-recording-${index}`).style.display = 'inline-block';

                    // Attach a click event to the Save button
                    document.getElementById(`save-recording-${index}`).addEventListener('click', () => {
                        saveRecording(audioBlob, index, `{{ addslashes($questions[$index]) }}`);
                    });

                    // Clear audio chunks for the next recording
                    audioChunks.length = 0;
                };
                mediaRecorder.start();
                setTimeout(() => mediaRecorder.stop(), 5000); // Stop after 5 seconds
            });
        });

        // Function to save the recording
        function saveRecording(blob, index, question) {
            const formData = new FormData();
            formData.append('audio', blob, `response-${index}.wav`);
            formData.append('question', question);

            fetch('/save-interview-response', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            }).then(response => {
                if (response.ok) {
                    alert("Response saved successfully!");
                } else {
                    alert("Failed to save response. Please try again.");
                }
            });
        }
    </script>
</x-app-layout>