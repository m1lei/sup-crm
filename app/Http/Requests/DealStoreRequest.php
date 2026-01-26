<?php

namespace App\Http\Requests;

use App\Models\Deal;
use Illuminate\Foundation\Http\FormRequest;

class DealStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return $this->user()->can('create', Deal::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            [
                'user_id' => 'required',
                'title' => 'required|max:50',
                'status'=> 'required|in:New,Todo,in_progress,Done',
                'amount'=>'nullable|numeric',
                'deadline_at'=>'nullable|date',
                'contact_id' => 'required|exists:contacts,id',
            ]
        ];
    }
}
