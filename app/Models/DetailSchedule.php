<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSchedule extends Model
{
    use HasFactory;

    protected $table = 'detail_schedules';

    protected $fillable = [
        'schedule_id',
        'day',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
