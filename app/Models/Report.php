<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'production_schedule_id',
        'created_by',
        'report_type'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function productionSchedule()
    {
        return $this->belongsTo(ProductionSchedule::class);
    }
}
