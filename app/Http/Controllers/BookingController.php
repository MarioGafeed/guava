<?php

namespace App\Http\Controllers;

use App\DataTables\BookingsDataTable;
use App\Http\Requests\BookingsRequest;
use App\Models\Appartment;
use App\Models\Booking;
use App\Models\Guest;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.bookings';

    public function index(BookingsDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.bookings'),
        ]);
    }

    public function create()
    {
        $guests = Guest::orderBy('id', 'DESC')->select('id', 'name')->where('active', 1)->get();
        $appartments = Appartment::orderBy('id', 'DESC')->select('id', 'name')->where('active', 1)->get();

        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.booking'),
            'guests' => $guests,
            'appartments' => $appartments,
        ]);
    }

    public function store(BookingsRequest $request)
    {
        $requestAll = $request->all();

        $appartment = Appartment::findOrFail($request->appartment_id);

        if($appartment->bookings->isNotEmpty()){

            $bedsReserved = $bedsCanceled = 0;

            foreach ($appartment->bookings as $booking) {
                                
                if ($booking->checkout_date >= $request->checkin_date && $booking->checkin_date <= $request->checkin_date) {  
                    if( $booking->pivot->status == 'reserved'){
                        $bedsReserved++; 
                    }elseif($booking->pivot->status == 'canceled'){
                        $bedsCanceled++;
                    }                   
                } 
            }    
            // dd('Reserved is: '.$bedsReserved .' Canceled is: '.$bedsCanceled);
            if ($bedsReserved - $bedsCanceled >= $appartment->hasBeds) {
  
                session()->flash('warning', trans('main.book_changedate'));
    
                return redirect()->route('bookings.create');
            }else{
                    $booking = Booking::create($requestAll);

                    $appartment->availableBeds = $appartment->availableBeds - 1;
                    $appartment->reservedBeds  = $appartment->reservedBeds + 1;
                    $appartment->save();
    
                    $appartment->bookings()->attach($booking->id);
                    $appartment->bookings()->updateExistingPivot($booking->id, [
                        'checkin_date'  => $booking->checkin_date,
                        'checkout_date' => $booking->checkout_date,
                        'guest_id'      => $booking->guest_id,
                    ]);

                    session()->flash('success', trans('main.added-message'));

                    return redirect()->route('bookings.index');
            }
        }else { 

            $booking = Booking::create($requestAll);
            
            $appartment->availableBeds = $appartment->availableBeds - 1;
            $appartment->reservedBeds = $appartment->reservedBeds + 1;
            $appartment->save();

            $appartment->bookings()->attach($booking->id);
            $appartment->bookings()->updateExistingPivot($booking->id, [
                'checkin_date' => $booking->checkin_date,
                'checkout_date' => $booking->checkout_date,
                'guest_id'      => $booking->guest_id,
            ]);

            session()->flash('success', trans('main.added-message'));

            return redirect()->route('bookings.index');
        }
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id)->with('guest')->with('appartment')->first();

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.booking').' : '.$booking->checkin_date,
            'show' => $booking,
        ]);
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $guests = Guest::select('id', 'name')->get();
        $appartments = Appartment::select('id', 'name')->get();

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.booking').' : '.$booking->id,
            'edit' => $booking,
            'guests' => $guests,
            'appartments' => $appartments,
        ]);
    }

    public function update(BookingsRequest $request, $id)
    {
        $booking = Booking::find($id);
        $booking->checkin_date = $request->checkin_date;
        $booking->guest_id = $request->guest_id;
        $booking->appartment_id = $request->appartment_id;
        $booking->active = $request->active;

        $booking->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('bookings.show', [$booking->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $booking = Booking::findOrFail($id);

        $booking->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('bookings.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('bookings.index');
        }
    }

    public function toggle($id)
    {
        $booking_appartment = Booking::findOrFail($id);
        $appartment = Appartment::findOrFail($booking_appartment->appartment_id);

        $booking = $appartment->bookings()->find($id);

        $booking->update([
            'active' => ! $booking->active,
        ]);

        if (! $booking->active) {
            $appartment->bookings()->updateExistingPivot($id, [
                'status' => 'canceled',
            ]);
        } else {
            $appartment->bookings()->updateExistingPivot($id, [
                'status' => 'reserved',
            ]);
        }

        return back();
    }
}
