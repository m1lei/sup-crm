<?php

namespace App\Http\Requests;

use App\Models\Deal;
use Illuminate\Foundation\Http\FormRequest;

class ActivityStoreActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $deal = Deal::findOrFail($this->input('deal_id'));//ищем объект deal по id из формы

        return $this->user()->can('update',$deal);//user()-возвращет объект текущего пользователя, can() обращается к Policy к которому привязан этот класс
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'deal_id' => 'required',
            'type' => 'required|in:call,email,meeting,note',
            'note' => 'required|string',
            'happened_at' => 'required|date'
        ];
    }
}
