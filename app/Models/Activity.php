<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'deal_id',
        'type',
        'note',
        'happened_at'
    ];
    public function deal()
    {
        return $this->belongsTo(Deal::class);
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
