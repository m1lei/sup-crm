<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Deal;
use App\Models\Task;
use App\Service\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\String\b;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TaskService $taskService)
    {
        //
        $user = $request->user();
        $filters = [
            'status' => $request->query('status', 'all'),
            'date'   => $request->query('date', 'all'),
        ];

        $task = $taskService->indexTasks($user, $filters);

        return view('task.index',compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function edit(Task $task)
    {
        //
        $this->authorize('update', $task);

        return view('task.edit',compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request, TaskService $taskService)
    {
        //
       $deal = $taskService->createTask($request->validated());

       return redirect()->route('deal.show',$deal->deal_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task, TaskService $taskService)
    {
        //
        $taskService->updateTask($request->validated(), $task);

        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, TaskService $taskService)
    {
        //
        $this->authorize('delete',$task);
        $taskService->deleteTask($task);

        return redirect()->route('deal.show',$task->deal_id);
    }
}
