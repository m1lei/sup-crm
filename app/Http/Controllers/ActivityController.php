<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Deal;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $deal = Deal::findOrFail($request->input('deal_id'));

        $this->authorize('update',$deal);

        $validated = $request->validate([
            'type' => 'required|in:call,email,meeting,note',
            'note' => 'required|string',
            'happened_at' => 'required|date'
        ]);

        $validated['deal_id'] = $deal->id;
        $validated['user_id'] = $request->user()->id;

        Activity::create($validated);

        return redirect()->route('deal.show', $deal);
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
    public function update(Request $request, Activity $activity)
    {
        //
        $this->authorize('update', $activity);

        $validate = $request->validate([
            'type' => 'required|in:call,email,meeting,note',
            'note' => 'required|string',
            'happened_at' => 'required|date'
        ]);

        $activity->update($validate);

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
