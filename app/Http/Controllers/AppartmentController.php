<?php

namespace App\Http\Controllers;

use App\DataTables\AppartmentsDataTable;
use App\Http\Requests\AppartmentsRequest;
use App\Models\Appartment;
use App\Models\Guest;
use App\Models\Place;
use Illuminate\Http\Request;

class AppartmentController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.appartments';

    public function index(AppartmentsDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.appartments'),
        ]);
    }

    public function create()
    {
        $places = Place::select('id', 'name')->get();

        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.appartments'),
            'places' => $places,
        ]);
    }

    public function store(AppartmentsRequest $request)
    {
        $requestAll = $request->all();

        $appartment = Appartment::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('appartments.index');
    }

    public function show($id)
    {
        $appartment = Appartment::findOrFail($id)->with('place')->first();

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.appartment').' : '.$appartment->name,
            'show' => $appartment,
        ]);
    }

    public function edit($id)
    {
        $appartment = Appartment::findOrFail($id);
        $places = Place::select('id', 'name')->get();

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.appartment').' : '.$appartment->name,
            'edit' => $appartment,
            'places' => $places,
        ]);
    }

    public function update(AppartmentsRequest $request, $id)
    {
        $appartment = Appartment::find($id);
        $appartment->name = $request->name;
        $appartment->place_id = $request->place_id;
        $appartment->active = $request->active;

        if ($appartment->hasBeds != $request->hasBeds) {
            $appartment->availableBeds = $request->hasBeds - $appartment->reservedBeds - $appartment->holdBeds;
        }

        $appartment->hasBeds = $request->hasBeds;

        $appartment->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('appartments.show', [$appartment->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $appartment = Appartment::findOrFail($id);

        $appartment->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('appartments.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('appartments.index');
        }
    }

    public function toggle($id)
    {
        $appartment = Appartment::findOrFail($id);

        $appartment->update([
            'active' => ! $appartment->active,
        ]);

        return back();
    }

    public function book($id)
    {
        $appartments = Appartment::where('id', $id)->get();

        if ($appartments[0]->availableBeds == 0) {
            session()->flash('warning', trans('main.book_notavailbed'));

            return redirect()->route('appartments.index');
        }

        if ($appartments[0]->active == 0) {
            session()->flash('warning', trans('main.appart_notactive'));

            return redirect()->route('appartments.index');
        }

        $guests = Guest::select('id', 'name')->get();

        return view('backend.bookings.create', [
            'title' => trans('main.book').' '.trans('main.appartment').' : '.$appartments[0]->name,
            'appartments' => $appartments,
            'guests' => $guests,
        ]);
    }
}
