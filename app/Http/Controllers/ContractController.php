<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $id = $user['id'];

        if ($user->isAdmin()) {
            $contacts = Contact::all();
        }else{
            $contacts = Contact::where('user_id', $id)->get();
        }


        return view('contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id = $request->user()['id'];//получить id текущего пользователя

        $validateDate = $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required',
            'company' => 'required',
            'note' => 'required',
        ]);
        $validateDate['user_id'] = $id;

        Contact::create($validateDate);

        return redirect()->route('contact.index')->with('sussec','Запись сохранена');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contact = Contact::findOrFail($id);
        $this->authorize('view', $contact);

        return view('contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        $this->authorize('view', $contact);

        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user_id = $request->user()['id'];
        $contact = Contact::findOrFail($id);

        $validateDate = $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'note' => 'required',
        ]);
        $validateDate['user_id'] = $user_id;

        $contact->update($validateDate);

        return redirect()->route('contact.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contact = Contact::findOrFail($id);
        $this->authorize('view', $contact);

        $contact->delete();

        redirect()->route('contact.index');
    }
}
