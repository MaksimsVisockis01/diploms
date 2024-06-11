<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\File;
use App\Models\Question;
use App\Models\Question_Comment;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function userStatistics(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'daily');
        $date = $request->input('date');
        $startDate = Carbon::parse($date ?: Carbon::now())->startOfDay();
        $endDate = Carbon::parse($date ?: Carbon::now())->endOfDay();

        if ($dateFilter == 'weekly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfWeek();
        } elseif ($dateFilter == 'monthly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfMonth();
        } elseif ($dateFilter == 'yearly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfYear();
        }

        // Диаграммы
        $userStats = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('admin', false)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get()
            ->toArray();

        return view('admin.statistics.users', compact('userStats', 'dateFilter', 'date'));
    }

    public function fileStatistics(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'daily');
        $date = $request->input('date');
        $startDate = Carbon::parse($date ?: Carbon::now())->startOfDay();
        $endDate = Carbon::parse($date ?: Carbon::now())->endOfDay();

        if ($dateFilter == 'weekly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfWeek();
        } elseif ($dateFilter == 'monthly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfMonth();
        } elseif ($dateFilter == 'yearly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfYear();
        }

        // Диаграммы
        $fileStats = File::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get()
            ->toArray();

        return view('admin.statistics.files', compact('fileStats', 'dateFilter', 'date'));
    }

    public function questionStatistics(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'daily');
        $date = $request->input('date');
        $startDate = Carbon::parse($date ?: Carbon::now())->startOfDay();
        $endDate = Carbon::parse($date ?: Carbon::now())->endOfDay();

        if ($dateFilter == 'weekly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfWeek();
        } elseif ($dateFilter == 'monthly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfMonth();
        } elseif ($dateFilter == 'yearly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfYear();
        }

        // Диаграммы
        $questionStats = Question::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get()
            ->toArray();

        return view('admin.statistics.questions', compact('questionStats', 'dateFilter', 'date'));
    }

    public function commentStatistics(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'daily');
        $date = $request->input('date');
        $startDate = Carbon::parse($date ?: Carbon::now())->startOfDay();
        $endDate = Carbon::parse($date ?: Carbon::now())->endOfDay();

        if ($dateFilter == 'weekly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfWeek();
        } elseif ($dateFilter == 'monthly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfMonth();
        } elseif ($dateFilter == 'yearly') {
            $startDate = Carbon::parse($date ?: Carbon::now())->startOfYear();
        }

        // Диаграммы
        $commentStats = Question_Comment::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get()
            ->toArray();

        return view('admin.statistics.comments', compact('commentStats', 'dateFilter', 'date'));
    }
}
