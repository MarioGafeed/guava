<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkin_date',
        'checkout_date',
        'appartment_id',
        'guest_id',
        'active',
    ];

    //    public function getCreatedAtAttribute($value)
    //       {

    //         //   return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
    //       }

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function appartment()
    {
        return $this->belongsTo('App\Models\Appartment', 'appartment_id');
    }

    public function appartments()
    {
        return $this->belongsToMany(Appartment::class)
            ->withPivot('status')
            ->withTimestamps();
    }
}
