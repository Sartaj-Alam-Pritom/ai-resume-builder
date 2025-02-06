<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResumeController extends Controller
{
    // Display the resume builder form
    public function show()
    {
        return view('resume-builder');
    }

    // Optimize the resume content using OpenAI API
    public function optimizeResume(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'experience' => 'required|string',
        ]);

        try {
            // Call OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            ])->post('https://api.openai.com/v1/completions', [
                'model' => 'text-davinci-003',
                'prompt' => "Optimize the following resume content for the Bangladeshi job market:\n\n" . $validated['experience'],
                'max_tokens' => 200,
            ]);

            if ($response->successful()) {
                $optimizedContent = $response->json()['choices'][0]['text'];
            } else {
                $optimizedContent = 'An error occurred while optimizing your resume. Please try again later.';
            }
        } catch (\Exception $e) {
            \Log::error('OpenAI API Error: ' . $e->getMessage());
            $optimizedContent = 'An unexpected error occurred. Please try again later.';
        }

        // Pass the optimized content to the view
        return view('resume-builder', [
            'optimizedContent' => $optimizedContent,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'experience' => $validated['experience'],
        ]);
    }
}