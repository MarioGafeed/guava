<?php

namespace App\Http\Controllers;

use App\DataTables\PlacesDataTable;
use App\Http\Requests\PlacesRequest;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.places';

    public function index(PlacesDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.places'),
        ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.place'),
        ]);
    }

    public function store(PlacesRequest $request)
    {
        $requestAll = $request->all();

        $place = Place::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('places.index');
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.place').' : '.$place->name,
            'show' => $place,
        ]);
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.place').' : '.$place->name,
            'edit' => $place,
        ]);
    }

    public function update(PlacesRequest $request, $id)
    {
        $place = Place::find($id);
        $place->name = $request->name;
        $place->address = $request->address;
        $place->active = $request->active;

        $place->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('places.show', [$place->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $place = Place::findOrFail($id);

        $place->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('places.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('place.index');
        }
    }

    public function toggle($id)
    {
        $place = Place::findOrFail($id);

        $place->update([
            'active' => ! $place->active,
        ]);

        return back();
    }
}
