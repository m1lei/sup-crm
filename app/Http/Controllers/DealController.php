<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $this->authorize('viewAny', Deal::class);

        $user = $request->user();

        if ($user->isAdmin()){
            $deal = Deal::all();
        } else{
            $deal = Deal::where('user_id',$user->id)->get();
        }
        return view('deal.index',compact('deal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $this->authorize('create', Deal::class);
        $user = $request->user();
        if($user->isadmin()){
            $contacts = Contact::all();
        }else{
            $contacts = Contact::where('user_id',$user->id)->get();
        }
        return view('deal.create',compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', Deal::class);

        $validateDate = $request->validate([
            'title' => 'required|max:50',
            'status'=> 'required|in:New,Todo,in_progress,Done',
            'amount'=>'nullable|numeric',
            'deadline_at'=>'nullable|date',
            'contact_id' => 'required|exists:contacts,id',
        ]);
        $validateDate['user_id'] = $request->user()->id;

        Deal::create($validateDate);

        return redirect()->route('deal.index')->with('sussec','Запись сохранена');
    }

    /**
     * страницы сделки
     */
    public function show(Deal $deal)
    {
        //TODO сейчас при показание ответсвенного user за сделку показывается его id нужно показывать его имя
        $this->authorize('view',$deal);

        $deal->load(['activities.user', 'contact']);
        return view('deal.show',compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        //
        $this->authorize('update',$deal);
        return view('deal.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        //
        $this->authorize('update',$deal);
        $validateDate = $request->validate([
            'title' => 'required|max:50',
            'status'=> 'required|in:New,Todo,in_progress,Done',
            'amount'=>'nullable|numeric',
            'deadline_at'=>'nullable|date',
        ]);
        $deal->update($validateDate);

        return redirect()->route('deal.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        //
        $this->authorize('delete',$deal);

        $deal->delete();

        return redirect()->route('deal.index');
    }
}
