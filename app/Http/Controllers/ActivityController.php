<?php

namespace App\Http\Controllers;

use App\Actions\Activity\CreateActivityActions;
use App\Actions\Activity\UpdateActivityAction;
use App\Http\Requests\ActivityStoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Deal;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityStoreActivityRequest $request, CreateActivityActions $actions)
    {
        //
        $actions->handle($request->validated(), $request->user()->id);

        return redirect()->route('deal.show', $request->deal_id);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
        $this->authorize('update',$activity );

        return view('activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request,UpdateActivityAction $actionUpdate, Activity $activity)
    {
        $actionUpdate->handle($request->validated(), $activity);

        return redirect()->route('deal.show',$activity->deal_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
        $this->authorize('delete', $activity);
        $activity->delete();

        return redirect()->route('deal.show',$activity->deal_id);

    }
}
