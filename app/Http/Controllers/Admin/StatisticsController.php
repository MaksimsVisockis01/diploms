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
    public function index(Request $request)
    {
        // Фильтры для выборки данных
        $dateFilter = $request->input('date_filter', 'daily'); // default to daily
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        if ($dateFilter == 'weekly') {
            $startDate = Carbon::now()->startOfWeek();
        } elseif ($dateFilter == 'monthly') {
            $startDate = Carbon::now()->startOfMonth();
        } elseif ($dateFilter == 'yearly') {
            $startDate = Carbon::now()->startOfYear();
        }

        // Получение данных
        $users = User::where('admin', false)->whereBetween('created_at', [$startDate, $endDate])->paginate(10);
        $files = File::with('user')->whereBetween('created_at', [$startDate, $endDate])->paginate(10);
        $questions = Question::with('user')->whereBetween('created_at', [$startDate, $endDate])->paginate(10);
        $comments = Question_Comment::with('user', 'question')->whereBetween('created_at', [$startDate, $endDate])->paginate(10);

        // Данные для диаграмм
        $userStats = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('admin', false)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $fileStats = File::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $questionStats = Question::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $commentStats = Question_Comment::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        return view('admin.statistics', compact('users', 'files', 'questions', 'comments', 'userStats', 'fileStats', 'questionStats', 'commentStats', 'dateFilter'));
    }
}
