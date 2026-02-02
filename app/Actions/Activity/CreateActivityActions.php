<?php

namespace App\Actions\Activity;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;

class CreateActivityActions
{
    /**
     * Создает запись Activity, привязанной к любой Model, имеющюю связь
     * MorhMany с Activity
     * автоматически определяет тип родителя(subject_type) и его id(subject_id)
     * @param array $data данные для заполнения
     * @param int $user_id кто совершил действие
     * @param Model $model модель родитель, к которой привязываем Activity
     * @return Activity
     *
     */
    public function handle(array $data, int $user_id, Model $model): Activity
    {
        return $model->activities()->create([
            'user_id' => $user_id,
            'type' => $data['type'],
            'note' => $data['note'],
            'happened_at' => $data['happened_at'],
        ]);
    }
}
