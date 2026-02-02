<?php

namespace App\Service;

use App\Models\Activity;
use App\Models\Deal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * Получить список активностей с учетом прав пользователя и контекста($subject)
     * @param User $user текущйи пользователь, фильтрация по автору
     * @param Model|null $subject Модель, если передана фильтруем по ней, если нет то отдаем все записи
     */
    public function getActivities(User $user, ?Model $subject = null)
    {
        $query = Activity::query()
            ->with([//для каждой записи загрузить кто ее создал(Model user)
                'user',
                'subject' => function ($morphTo) {//как загружать данные в зависимости от типа в subject
                    $morphTo->morphWith([
                        Deal::class => ['contact'],//для subject Deal подгрузить еше и Model Contact
                    ]);
                }
            ]);

        // Ограничение прав
        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        //Фильтр по subject только если он передан
        if ($subject) {
            $query->whereMorphedTo('subject', $subject);
        }

        return $query
            ->orderByDesc('happened_at')
            ->limit(5)
            ->get();
    }

}
