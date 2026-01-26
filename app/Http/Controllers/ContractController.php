<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Service\ContactService;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ContactService $service)
    {
        $this->authorize('viewAny', Contact::class);

        $user = $request->user();

        $contacts = $service->getContractsForUsers($user);

        return view('contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Contact::class);
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request, ContactService $service)
    {
        //validated
        $service->CreateContracts($request->validated(), $request->user()->id);


        return redirect()->route('contact.index')->with('sussec','Запись сохранена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
        $this->authorize('view', $contact);

        return view('contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);

        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     * Contact $contact: Laravel привязывает маршрут к модели и сама делает FindOrFail по id из url
     */
    public function update(UpdateContractRequest $request, Contact $contact, ContactService $service)
    {
        //
        $service->updateContract($contact, $request->validated());

        return redirect()->route('contact.index')->with('success','контакт обновлен');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact, ContactService $service)
    {
        //
        $service->deleteContract($contact);

        return redirect()->route('contact.index');
    }
}
