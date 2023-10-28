<?php

namespace App\Console\Commands;

use App\Models\Appartment;
use App\Models\Booking;
use Illuminate\Console\Command;

class UpdateGuestsBookingBookingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-guests-booking-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates guests booking status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Booking::with('guest')->get() as $booking) {
            $currentMonthDay = now()->format('d');

            $isInVacation = $currentMonthDay >= $booking->guest->vacation_day_start && $currentMonthDay <= $booking->guest->vacation_day_end;

            $appartment = Appartment::findOrFail($booking->appartment_id);

            $bookingStatus = $appartment->bookings()->find($booking->id)?->pivot?->status;

            if ($bookingStatus === 'canceled') {
                continue;
            }

            if ($isInVacation) {
                $appartment->bookings()->updateExistingPivot($booking->id, [
                    'status' => 'hold',
                ]);
            } else {
                $appartment->bookings()->updateExistingPivot($booking->id, [
                    'status' => 'reserved',
                ]);
            }
        }

        return 0;
    }
}
