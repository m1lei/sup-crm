<?php

namespace App\Service;

use App\Models\Task;
use App\Models\User;

class TaskService
{
    public function indexTasks(User $user, array $filters)
    {
        $query = Task::where('assignee_id',$user->id);
        //фильтр по статусу

        if ($filters['status'] != 'all') {
            $query->where('status',$filters['status']);
        }
        //фильтр по дате
        if ($filters['date'] != 'all') {
            $today = now()->startOfDay();
            switch ($filters['date']) {
                case 'overdue':
                    $query->where('deadline_at','<',$today);
                    break;
                case 'today':
                    $query->where('deadline_at', '=', $today);
                    break;
                case 'future':
                    $query->where('deadline_at','>',$today);
                    break;
            }
        }
        return $query->orderBy('deadline_at')->paginate(15);


    }

    public function createTask(array $data)
    {
        $payload = [
            'deal_id' => $data['deal_id'],
            'assignee_id' => $data['assignee_id'],//id создателя задачи
            'title' => $data['title'],
            'deadline_at' => $data['deadline_at'],
            'status' => $data['status'],
        ];
        return Task::create($payload);
    }

    public function updateTask(array $data, Task $task)
    {
        $task->update($data);
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}
