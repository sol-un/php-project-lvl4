<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'assigned_to_id'
    ];

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
