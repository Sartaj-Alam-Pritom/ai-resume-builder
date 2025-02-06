<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // Import the Http facade

class InterviewController extends Controller
{
    public function simulateInterview()
    {
        // Default questions if API fails or no questions are generated
        $defaultQuestions = [
            "Tell me about yourself.",
            "What are your strengths?",
            "Why do you want to work here?"
        ];

        try {
            // Call OpenAI API to generate interview questions (optional)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            ])->post('https://api.openai.com/v1/completions', [
                'model' => 'text-davinci-003',
                'prompt' => "Generate 5 common interview questions for a software developer position.",
                'max_tokens' => 200,
            ]);

            // Log the API response for debugging
            \Log::info('OpenAI API Response: ' . $response->body());

            if ($response->successful()) {
                $questions = explode("\n", trim($response->json()['choices'][0]['text']));
                $questions = array_filter($questions); // Remove empty lines
            } else {
                $errorBody = $response->json();
                \Log::error('OpenAI API Error: ' . json_encode($errorBody));
                $questions = $defaultQuestions;
            }
        } catch (\Exception $e) {
            \Log::error('OpenAI API Exception: ' . $e->getMessage());
            $questions = $defaultQuestions;
        }

        return view('interview-simulation', ['questions' => $questions]);
    }

    public function saveResponse(Request $request)
    {
        $request->validate([
            'audio' => 'required|file|mimes:wav',
            'question' => 'required|string',
        ]);

        // Store the audio file
        $path = $request->file('audio')->store('interview-responses', 'public');

        // Save the response to the database
        auth()->user()->interviewResponses()->create([
            'question' => $request->input('question'),
            'audio_file_path' => $path,
        ]);

        return response()->json(['message' => 'Response saved successfully']);
    }
}