<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealStoreRequest;
use App\Http\Requests\DealUpdateRequest;
use App\Models\Contact;
use App\Models\Deal;
use App\Service\ContactService;
use App\Service\DealService;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DealService $dealService)
    {
        //
        $this->authorize('viewAny', Deal::class);
        $user = $request->user();

        $deal = $dealService->GetDeals($user);

        return view('deal.index',compact('deal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, ContactService $contactService)
    {
        //
        $this->authorize('create', Deal::class);
        $user = $request->user();

        $contacts = $contactService->getContractsForUsers($user);

        return view('deal.create',compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DealStoreRequest $request, DealService $dealService)
    {
        //
        $dealService->CreateDeal($request->validated(), $request->user()->id);

        return redirect()->route('deal.index')->with('sussec','Запись сохранена');
    }

    /**
     * страницы сделки
     */
    public function show(Deal $deal)
    {
        $this->authorize('view',$deal);

        $deal->load(['activities.user', 'contact']);
        return view('deal.show',compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal, Request $request, ContactService $contactService)
    {
        //
        $user = $request->user();
        $this->authorize('update',$deal);

        $contacts = $contactService->getContractsForUsers($user);

        return view('deal.edit', compact('deal', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DealUpdateRequest $request, DealService $dealService, Deal $deal)
    {
        //
        $dealService->UpdateDeal($request->validated(), $deal);


        return redirect()->route('deal.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal, DealService $dealService)
    {
        //
        $this->authorize('delete',$deal);

        $dealService->DeleteDeal($deal);

        return redirect()->route('deal.index');
    }
}
