<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;

class ActivityStoreActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public Model $subject;
    public function authorize(): bool
    {
        //из формы получаем даныне
        $type = $this->input('subject_type');
        $id = $this->input('subject_id');

        $class = Relation::getMorphedModel($type);//Получаем класс модели
        $this->subject = $class::findOrFail($id);



        return $this->user()->can('update',$this->subject);//user()-возвращет объект текущего пользователя, can() обращается к Policy к которому привязан этот класс
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject_type' => 'required',
            'subject_id' => 'required',
            'type' => 'required|in:call,email,meeting,note',
            'note' => 'required|string',
            'happened_at' => 'required|date'
        ];
    }
}
