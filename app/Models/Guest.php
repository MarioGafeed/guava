<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'image',
        'identity',
        'phone',
        'vacation_day_start',
        'vacation_day_end',
        'workplace_id',
    ];

    public function workplace()
    {
        return $this->belongsTo('App\Models\Workplace', 'workplace_id');
    }

    public function booking()
    {
        return $this->belongsTo('App\Models\Booking', 'booking_id');
    }
}
