<?php

namespace App\Service;

use App\Models\Activity;
use App\Models\Deal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Получение задач пользователя по сделкам, если передан 2 аргуемент то ищется по контретной сделке
     * @param User $user
     * @param $deal
     * @return array
     */
    public function getTasks(User $user, $deal=null)//$deal - объект Deal
    {
        $today = now()->startOfDay();

        $query = Task::where('assignee_id', $user->id)
            ->where('status','open');

        if ($deal){
            $query->where('deal_id', $deal->id);
        }
        return [
            'overdue' => (clone $query)->where('deadline_at', '<', $today)->limit(5)->get(),
            'today' => (clone $query)->whereDate('deadline_at', $today)->limit(5)->get(),
            'future' => (clone $query)->where('deadline_at', '>', $today)->limit(5)->get(),
        ];
    }

    public function getDeal(User $user)
    {
        $query = Deal::query();
        if (!$user->isAdmin())
        {
            $query->where('user_id', $user->id);
        }
        return $query->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

    }
    public function getActivities(User $user, $deal=null)
    {
        $query = Activity::with(['deal.contact', 'user']);
        if (!$user->isAdmin()){
            $query->where('user_id', $user->id);
        }
        if ($deal){
            $query->where('deal_id', $deal->id);
        }
        return $query->orderBy('created_at', 'desc')->limit(5)->get();
    }
}
