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
        $this->authorize('viewAny', Contact::class);

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
        $this->authorize('create', Contact::class);
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', Contact::class);
        $id = $request->user()['id'];//получить id текущего пользователя

        $validateDate = $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required',
            'company' => 'required',
            'note' => 'required',
        ],
         [
             'required'=>'поле обязательно для заполнения',
             'email' => 'Некоректный email',
             'unique'=>'такой email уже существует',
             'max' => 'слишком длинное название'
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
        $this->authorize('update', $contact);

        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $contact = Contact::findOrFail($id);
        $this->authorize('update', $contact);

        $validateDate = $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'note' => 'required',
        ]);

        $contact->update($validateDate);

        return redirect()->route('contact.index')->with('success','контакт обновлен');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $contact = Contact::findOrFail($id);

        $this->authorize('delete', $contact);

        $contact->delete();

        return redirect()->route('contact.index');
    }
}
