<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Contact::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required',
            'company' => 'required',
            'note' => 'required',
        ];
    }

    /**
     * Кастомные ответы на ошибки
     * @return array
     */
    public function messages(): array
    {
        return [
                'required'=>'поле обязательно для заполнения',
                'email' => 'Некоректный email',
                'unique'=>'такой email уже существует',
                'max' => 'слишком длинное название'
        ];
    }
}
