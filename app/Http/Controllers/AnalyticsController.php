<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        // Cache resume errors for 10 minutes
        $resumeErrors = Cache::remember('resume_errors_' . Auth::id(), now()->addMinutes(10), function () {
            return [
                'Spelling Errors' => DB::table('resumes')
                    ->where('user_id', Auth::id())
                    ->where('error_type', 'spelling')
                    ->count(),
                'Formatting Issues' => DB::table('resumes')
                    ->where('user_id', Auth::id())
                    ->where('error_type', 'formatting')
                    ->count(),
                'Keyword Missing' => DB::table('resumes')
                    ->where('user_id', Auth::id())
                    ->where('error_type', 'keywords')
                    ->count(),
            ];
        });

        // Cache interview performance metrics
        $interviewPerformance = Cache::remember('interview_performance_' . Auth::id(), now()->addMinutes(10), function () {
            return DB::table('interview_responses')
                ->where('user_id', Auth::id())
                ->selectRaw('AVG(confidence_score) as avg_confidence, AVG(clarity_score) as avg_clarity')
                ->first();
        });

        // Cache user activity trends
        $userActivity = Cache::remember('user_activity_' . Auth::id(), now()->addMinutes(10), function () {
            return [
                'resumes_generated' => DB::table('resumes')->where('user_id', Auth::id())->count(),
                'cover_letters_generated' => DB::table('cover_letters')->where('user_id', Auth::id())->count(),
                'interviews_simulated' => DB::table('interview_responses')->where('user_id', Auth::id())->count(),
            ];
        });

        return view('analytics-dashboard', [
            'resumeErrors' => $resumeErrors,
            'interviewPerformance' => $interviewPerformance,
            'userActivity' => $userActivity,
        ]);
    }

    public function export()
    {
        // Fetch data for export
        $resumeErrors = [
            'Spelling Errors' => DB::table('resumes')
                ->where('user_id', Auth::id())
                ->where('error_type', 'spelling')
                ->count(),
            'Formatting Issues' => DB::table('resumes')
                ->where('user_id', Auth::id())
                ->where('error_type', 'formatting')
                ->count(),
            'Keyword Missing' => DB::table('resumes')
                ->where('user_id', Auth::id())
                ->where('error_type', 'keywords')
                ->count(),
        ];

        $interviewPerformance = DB::table('interview_responses')
            ->where('user_id', Auth::id())
            ->selectRaw('AVG(confidence_score) as avg_confidence, AVG(clarity_score) as avg_clarity')
            ->first();

        $userActivity = [
            'resumes_generated' => DB::table('resumes')->where('user_id', Auth::id())->count(),
            'cover_letters_generated' => DB::table('cover_letters')->where('user_id', Auth::id())->count(),
            'interviews_simulated' => DB::table('interview_responses')->where('user_id', Auth::id())->count(),
        ];

        // Export as CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics-data.csv"',
        ];

        $callback = function () use ($resumeErrors, $interviewPerformance, $userActivity) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Metric', 'Value']);

            // Resume Errors
            foreach ($resumeErrors as $key => $value) {
                fputcsv($file, [$key, $value]);
            }

            // Interview Performance
            fputcsv($file, ['Average Confidence Score', $interviewPerformance->avg_confidence ?? 0]);
            fputcsv($file, ['Average Clarity Score', $interviewPerformance->avg_clarity ?? 0]);

            // User Activity
            foreach ($userActivity as $key => $value) {
                fputcsv($file, [ucwords(str_replace('_', ' ', $key)), $value]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

