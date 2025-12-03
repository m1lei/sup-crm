<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
        $deal = Deal::findOrFail($request->input('deal_id'));
        $this->authorize('update', $deal);

        $validate = $request->validate([
            'title' => 'required|max:255',
            'deadline_at' => 'required',
            'status' => 'required|in:open,done'
        ]);
        $validate['deal_id'] = $deal->id;
        $validate['assignee_id'] = $request->user()->id;

        Task::create($validate);

        return redirect()->route('deal.show',$deal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $this->authorize('update',$task);

        $validate = $request->validate([
            'title' => 'required|max:255',
            'deadline_at' => 'required|date',
            'status' => 'required|in:open,done'
        ]);

        $task->update($validate);
        Log::info('Redirect to Deal ID' . $task->deal_id);
        return redirect()->route('deal.show',$task->deal_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $this->authorize('delete',$task);
        $task->delete();
        return redirect()->route('deal.show',$task->deal_id);
    }
}
