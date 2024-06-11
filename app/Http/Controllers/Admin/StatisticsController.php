<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\Question;
use App\Models\Question_Comment;
use Carbon\Carbon;
use DB;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'daily');
        $date = $request->input('date');
        $intervals = $request->input('intervals', 7); // Default to 7 intervals
        $currentDate = Carbon::parse($date ?: Carbon::now());

        switch ($dateFilter) {
            case 'weekly':
                $startDate = $currentDate->copy()->subWeeks($intervals)->startOfWeek();
                $endDate = $currentDate->endOfWeek();
                $dateFormat = '%Y-%u'; // Weekly format
                break;
            case 'monthly':
                $startDate = $currentDate->copy()->subMonths($intervals)->startOfMonth();
                $endDate = $currentDate->endOfMonth();
                $dateFormat = '%Y-%m'; // Monthly format
                break;
            case 'yearly':
                $startDate = $currentDate->copy()->subYears($intervals)->startOfYear();
                $endDate = $currentDate->endOfYear();
                $dateFormat = '%Y'; // Yearly format
                break;
            case 'daily':
            default:
                $startDate = $currentDate->copy()->subDays($intervals)->startOfDay();
                $endDate = $currentDate->endOfDay();
                $dateFormat = '%Y-%m-%d'; // Daily format
                break;
        }

        $userStats = User::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as date"), DB::raw('COUNT(*) as count'))
            ->where('admin', false)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $fileStats = File::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as date"), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $questionStats = Question::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as date"), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $commentStats = Question_Comment::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as date"), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        return view('admin.statistics.index', compact('userStats', 'fileStats', 'questionStats', 'commentStats', 'dateFilter', 'date', 'intervals'));
    }
}
