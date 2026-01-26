<?php

namespace App\Http\Requests;

use App\Models\Deal;
use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $deal_id = $this->input('deal_id');
        $deal = Deal::findOrFail($deal_id);

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
            'deal_id' => 'required|exists:deals,id',
            'assignee_id' => 'required|',
            'title' => 'required|max:255',
            'deadline_at' => 'required',
            'status' => 'required|in:open,done'
        ];
    }
}
