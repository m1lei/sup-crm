<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'deal_id',
        'assignee_id',
        'title',
        'deadline_at',
        'status'
    ];

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class,'assignee_id');
    }
}
