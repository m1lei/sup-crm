<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;
    //данные которые заполняем
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'note'
    ];

    //получить менеджера(user_id) по contact, связь таблицы
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deals() {
        return $this->hasMany(Deal::class);
    }
    //Полиморфная связь один ко многим
    public function activities() {
        return $this->morphMany(Activity::class, 'subject');
    }
}
