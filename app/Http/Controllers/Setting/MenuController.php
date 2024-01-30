<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->menu = "SETTING.MENU";
        $this->url = url('setting/menu');
        $this->title = "Menu";
        $this->view = "setting.menu.";
    }

    public function index()
    {
        $this->authAction('read');
        $this->authCheckDetailAccess();

        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Home'],
            ["url" => "#", "title" => "Setting"],
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

        $data = Menu::with('parent')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
