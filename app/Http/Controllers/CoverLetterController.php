<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CoverLetter; 

class CoverLetterController extends Controller
{
    public function show()
    {
        return view('cover-letter-generator');
    }

    public function generateCoverLetter(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'job_description' => 'required|string',
        ]);

        $jobTitle = $validated['job_title'];
        $companyName = $validated['company_name'];
        $jobDescription = $validated['job_description'];

        try {
            // Call OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            ])->post('https://api.openai.com/v1/completions', [
                'model' => 'text-davinci-003',
                'prompt' => "Write a personalized cover letter for the position of $jobTitle at $companyName based on the following job description:\n\n$jobDescription",
                'max_tokens' => 300,
            ]);

            // Check if the API response is successful
            if ($response->successful()) {
                $coverLetter = $response->json()['choices'][0]['text'];
            } else {
                $coverLetter = "Sorry, we encountered an issue generating your cover letter. Please try again later.";
            }
        } catch (\Exception $e) {
            \Log::error('OpenAI API Error: ' . $e->getMessage());
            $coverLetter = "An unexpected error occurred. Please try again later.";
        }

        // Save cover letter to the database
        if (auth()->check()) {
            CoverLetter::create([
                'user_id' => auth()->id(),
                'job_title' => $jobTitle,
                'company_name' => $companyName,
                'job_description' => $jobDescription,
                'cover_letter' => $coverLetter,
            ]);
        }

        return view('cover-letter-generator', ['coverLetter' => $coverLetter]);
    }
}