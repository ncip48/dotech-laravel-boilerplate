<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Setting\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->menu = "MASTER.USER";
        $this->url = url('master/user');
        $this->title = "User";
        $this->view = "master.user.";
    }

    public function index()
    {
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Home'],
            ["url" => "#", "title" => "Master"],
            ['url' => $this->url, 'title' => $this->title],
        ];

        return view($this->view . 'index')->with('title', $this->title)
            ->with('url', $this->url)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('allowAccess', $this->authAccess());
    }

    public function list()
    {
        $this->authAction('read');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = User::with('group')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        $this->authAction('create');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $groups = Group::all();

        return view($this->view . 'action')
            ->with('title', 'Add ' . $this->title)
            ->with('url', $this->url)
            ->with('groups', $groups);
    }

    public function store(Request $request)
    {
        $this->authAction('create');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'username' => 'required|unique:users,username',
                'group_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = [];
                foreach ($validator->errors()->all() as $error) {
                    $errors[] = $error;
                }
                return $this->setResponse(false, "Validation Error", $errors);
            }

            $res = User::create([
                'username' => $request->username,
                'group_id' => $request->group_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "is_active" => $request->is_active ?? "0",
            ]);

            return $this->setResponse(true, $this->saveSuccessMessage, $res);
        }

        return redirect('/');
    }

    public function edit($id)
    {
        $this->authAction('update');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = User::find($id);

        $groups = Group::all();

        return (!$data) ? $this->showError("No data found with id: $id") :
            view($this->view . 'action')
            ->with('url', $this->url . '/' . $id)
            ->with('title', 'Edit ' . $this->title)
            ->with('id', $id)
            ->with('data', $data)
            ->with('groups', $groups);
    }

    public function update(Request $request, $id)
    {
        $this->authAction('update');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                'username' => 'required|unique:users,username,' . $id . ',user_id',
                'group_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id . ',user_id',
                'password' => 'nullable|min:8',
            ];

            if ($request->password) {
                $rules['password'] = 'required|min:8';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = [];
                foreach ($validator->errors()->all() as $error) {
                    $errors[] = $error;
                }
                return $this->setResponse(false, "Validation Error", $errors);
            }

            $res = User::where('user_id', $id)->update([
                'username' => $request->username,
                'group_id' => $request->group_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => ($request->password) ? Hash::make($request->password) : User::where('user_id', $id)->first()->password,
                "is_active" => $request->is_active ?? "0",
            ]);

            return $this->setResponse(true, $this->updateSuccessMessage, $res);
        }

        return redirect('/');
    }

    public function show($id)
    {
        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Home'],
            ["url" => "#", "title" => "Master"],
            ['url' => $this->url, 'title' => $this->title],
            ['url' => '#', 'title' => 'Detail'],
        ];

        $data = User::with('group')->findOrFail($id);

        return view($this->view . 'show')->with('title', $this->title)
            ->with('url', $this->url)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('data', $data);
    }

    public function confirm($id)
    {
        $this->authAction('delete');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = User::find($id);

        return (!$data) ? $this->showError("No data found with id: $id") :
            view('layouts.modal_delete')
            ->with('url', $this->url . '/' . $id)
            ->with('title', 'Delete ' . $this->title)
            ->with('id', $id)
            ->with('data', $data)
            ->with('action', 'delete')
            ->with('info', ["Name" => "$data->name", "Username" => "$data->username", "Email" => "$data->email"]);
    }

    public function destroy($id)
    {
        $this->authAction('delete');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $res = User::destroy($id);

        return (!$res) ? $this->showError("No data found with id: $id") :
            $this->setResponse(true, $this->deleteSuccessMessage, $res);
    }
}
