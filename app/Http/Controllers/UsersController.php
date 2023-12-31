<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\UsersDataTable;
use App\Helpers\Helper;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    // use Authorizable;
    private $viewPath = 'backend.users';

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
            'title' => trans('main.show-all').' '.trans('main.users'),
        ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
            'title' => trans('main.add').' '.trans('main.users'),
            'roles' => Role::get(),
        ]);
    }

    public function store(UsersRequest $request)
    {
        $requestAll = $request->all();

        $requestAll['image'] = Helper::Upload('users', $request->file('image'), 'checkImages');
        $requestAll['password'] = Hash::make($request->password);

        $user = User::create($requestAll);

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        // $user = User::where('id', $id)->with('class_relation')->first();
        $user = User::findOrFail($id);

        return view("{$this->viewPath}.show", [
            'title' => trans('main.show').' '.trans('main.user').' : '.$user->name,
            'show' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'title' => trans('main.edit').' '.trans('main.user').' : '.$user->name,
            'edit' => $user,
            'roles' => Role::get(),
        ]);
    }

    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password') && ! empty($request->password) && ! is_null($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->type = $request->type;
        $user->phone = $request->phone;

        if ($request->hasFile('image')) {
            $user->image = Helper::UploadUpdate($user->image ?? '', 'users', $request->file('image'), 'checkImages');
        }
        $user->save();

        $roles = $request['roles']; //Retreive all roles

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        session()->flash('success', trans('main.updated'));

        return redirect()->route('users.show', [$user->id]);
    }

    public function destroy($id, $redirect = true)
    {
        $user = User::findOrFail($id);
        if (file_exists(public_path('uploads/'.$user->image))) {
            @unlink(public_path('uploads/'.$user->image));
        }
        $user->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('users.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('users.index');
        }
    }
}
