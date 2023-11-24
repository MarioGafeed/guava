<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Appartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hasBeds', 'availableBeds', 'bedshold', 'reservedBeds', 'place_id', 'active'];

    public function place()
    {
        return $this->belongsTo('App\Models\Place', 'place_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function reservationsByDateRange(string $status = 'reserved', Carbon $from = null, Carbon $to = null): Collection
    {
        return DB::table('appartment_booking')
            ->select('checkin_date', 'checkout_date', DB::raw('count(*) as reservations_count'))
            ->where('appartment_id', $this->id)
            ->where('status', $status)
            ->when($from, fn ($q) => $q->where('checkin_date', '>=', $from))
            ->when($to, fn ($q) => $q->where('checkout_date', '<=', $to))
            ->groupBy('checkin_date', 'checkout_date')
            ->get();
    }
}
