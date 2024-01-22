<?php

namespace App\Http\Controllers;

use App\Models\Setting\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('dashboard.index')->with('menus', $menus);
    }
}
