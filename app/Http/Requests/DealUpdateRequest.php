<?php

namespace App\Http\Requests;

use App\Models\Deal;
use Illuminate\Foundation\Http\FormRequest;

class DealUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $deal = $this->route('deal');
        return $this->user()->can('update', $deal);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:50',
            'status'=> 'required|in:New,Todo,in_progress,Done',
            'amount'=>'nullable|numeric',
            'deadline_at'=>'nullable|date',
        ];
    }
}
