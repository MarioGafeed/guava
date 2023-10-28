<?php

namespace App\Http\Controllers;

use App\DataTables\WorkplacesDataTable;
use App\Http\Requests\WorkplacesRequest;
use App\Models\Workplace;
use Illuminate\Http\Request;

class WorkPlaceController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.workplaces';

    public function index(WorkplacesDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.workplaces'),
        ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.workplace'),
        ]);
    }

    public function store(workplacesRequest $request)
    {
        $requestAll = $request->all();

        $workplace = Workplace::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('workplaces.index');
    }

    public function show($id)
    {
        $workplace = Workplace::findOrFail($id);

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.workplace').' : '.$workplace->name,
            'show' => $workplace,
        ]);
    }

    public function edit($id)
    {
        $workplace = Workplace::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.workplace').' : '.$workplace->name,
            'edit' => $workplace,
        ]);
    }

    public function update(workplacesRequest $request, $id)
    {
        $workplace = Workplace::find($id);
        $workplace->name = $request->name;
        $workplace->address = $request->address;
        $workplace->phone = $request->phone;

        $workplace->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('workplaces.show', [$workplace->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $workplace = Workplace::findOrFail($id);

        $workplace->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('workplaces.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('workplace.index');
        }
    }
}
