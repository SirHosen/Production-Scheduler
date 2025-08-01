<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'production_schedule_id',
        'assigned_to',
        'status',
        'due_date',
        'priority'
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function productionSchedule()
    {
        return $this->belongsTo(ProductionSchedule::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
