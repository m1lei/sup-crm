<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'user_id',
        'title',
        'status',
        'amount',
        'deadline_at'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject')->orderByDesc('happened_at');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderByDesc('deadline_at');
    }
}
