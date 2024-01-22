<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
        $this->authAction('read', 'json');
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

        return view($this->view . 'action')
            ->with('title', 'Tambah ' . $this->title)
            ->with('url', $this->url);
    }

    public function edit($id)
    {
        $this->authAction('update',);
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $data = User::find($id);

        return (!$data) ? $this->showError("No data found with id: $id") :
            view($this->view . 'action')
            ->with('url', $this->url . '/' . $id)
            ->with('title', 'Edit ' . $this->title)
            ->with('id', $id)
            ->with('data', $data);
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
}
