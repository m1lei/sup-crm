<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Deal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request){

        $user = $request->user();
        $today = now()->startOfDay();
        $endToDay = $today->copy()->endOfDay();



        $taskOverdue = Task::where('assignee_id', $user->id)
            ->where('deadline_at', "<", $today)
            ->where('status','open')->get();

        $taskFuture = Task::where('assignee_id', $user->id)
            ->where('deadline_at',">",$today)
            ->where('status','open')->get();

        $taskToday = Task::where('assignee_id', $user->id)
            ->whereDate('deadline_at',"=",[$today, $endToDay])
            ->where('status','open')->get();

        $query = Deal::query(); // Используем $query, чтобы не путать
        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        // Продолжаем запрос, используя $query
        $deals = $query->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count','status');


        $dealsTotal = Deal::where('user_id', $user->id)
            ->whereIn('status',['New','Todo','in_progress'])
            ->where('deadline', "<",$today)->count();

        $activitiesQuery = Activity::with(['deal', 'deal.contact'])
            ->orderBy('happened_at', 'desc')
            ->limit(10);

        if (!$user->isAdmin()) {
            $activitiesQuery->where('user_id', $user->id);
        }

        $recentActivities = $activitiesQuery->get();

        return view('dashboard',compact(
            'taskFuture',
            'taskOverdue',
            'taskToday',
            'deals',
            'dealsTotal',
            'recentActivities'
        ));
    }
}
