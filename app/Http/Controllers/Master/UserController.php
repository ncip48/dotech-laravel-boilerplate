<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->menu = "DASHBOARD";
        $this->url = url('/dashboard');
        $this->title = "Dashboard";
        $this->view = "dashboard.";
    }

    public function index()
    {
        $breadcrumbs = [
            ['url' => $this->url, 'title' => $this->title],
        ];
        return view('dashboard.index')->with('title', $this->title)
            ->with('url', $this->url)
            ->with('breadcrumbs', $breadcrumbs);
    }
}
