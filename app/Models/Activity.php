<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id', //id записи
        'subject_type',//тип модели
        'type',
        'note',
        'happened_at'
    ];

    //Получить модель, к которой относится активность (Deal, Contact и т.д.)
    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Преобразование строки из БД в объект Carbon (datetime) для удобной работы с датами
    protected $casts = [
      'happened_at' => 'datetime'
    ];
}
