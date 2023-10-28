<?php

namespace App\Http\Controllers;

use App\DataTables\GuestsDataTable;
use App\Helpers\Helper;
use App\Http\Requests\GuestsRequest;
use App\Models\Guest;
use App\Models\Workplace;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.guests';

    public function index(GuestsDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.guests'),
        ]);
    }

    public function create()
    {
        $workplaces = Workplace::select('id', 'name')->get();

        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.guests'),
            'workplaces' => $workplaces,
        ]);
    }

    public function store(GuestsRequest $request)
    {
        $requestAll = $request->all();

        $requestAll['image'] = Helper::Upload('guests', $request->file('image'), 'checkImages');

        $guest = Guest::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('guests.index');
    }

    public function show($id)
    {
        $guest = Guest::findOrFail($id)->with('workplace')->first();

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.guest').' : '.$guest->name,
            'show' => $guest,
        ]);
    }

    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        $workplaces = Workplace::select('id', 'name')->get();

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.guest').' : '.$guest->name,
            'edit' => $guest,
            'workplaces' => $workplaces,
        ]);
    }

    public function update(GuestsRequest $request, $id)
    {
        $guest = Guest::find($id);
        $guest->name = $request->name;
        $guest->phone = $request->phone;
        $guest->identity = $request->identity;
        $guest->vacation_day_start = $request->vacation_day_start;
        $guest->vacation_day_end = $request->vacation_day_end;
        $guest->workplace_id = $request->workplace_id;
        $guest->active = $request->active;

        if ($request->hasFile('image')) {
            $guest->image = Helper::UploadUpdate($guest->image ?? '', 'guests', $request->file('image'), 'checkImages');
        }

        $guest->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('guests.show', [$guest->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $guest = Guest::findOrFail($id);
        if (file_exists(public_path('uploads/'.$guest->image))) {
            @unlink(public_path('uploads/'.$guest->image));
        }
        $guest->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('guests.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('guests.index');
        }
    }

    public function toggle($id)
    {
        $guest = Guest::findOrFail($id);

        $guest->update([
            'active' => ! $guest->active,
        ]);

        return back();
    }
}
