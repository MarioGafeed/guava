<?php

namespace App\Http\Controllers;

use App\DataTables\OwnersDataTable;
use App\Helpers\Helper;
use App\Http\Requests\OwnersRequest;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.owners';

    public function index(OwnersDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.owners'),
        ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.owners'),
        ]);
    }

    public function store(OwnersRequest $request)
    {
        $requestAll = $request->all();

        $requestAll['image'] = Helper::Upload('owners', $request->file('image'), 'checkImages');

        $owner = Owner::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('owners.index');
    }

    public function show($id)
    {
        $owner = Owner::findOrFail($id);

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.owner').' : '.$owner->name,
            'show' => $owner,
        ]);
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.owner').' : '.$owner->name,
            'edit' => $owner,
        ]);
    }

    public function update(OwnersRequest $request, $id)
    {
        $owner = Owner::find($id);
        $owner->name = $request->name;
        $owner->phone = $request->phone;
        $owner->active = $request->active;

        if ($request->hasFile('image')) {
            $owner->image = Helper::UploadUpdate($owner->image ?? '', 'owners', $request->file('image'), 'checkImages');
        }

        $owner->save();

        session()->flash('success', trans('main.updated'));

        return redirect()->route('owners.show', [$owner->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $owner = Owner::findOrFail($id);
        if (file_exists(public_path('uploads/'.$owner->image))) {
            @unlink(public_path('uploads/'.$owner->image));
        }
        $owner->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('owners.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('owner.index');
        }
    }

    public function toggle($id)
    {
        $owner = Owner::findOrFail($id);

        $owner->update([
            'active' => ! $owner->active,
        ]);

        return back();
    }
}
