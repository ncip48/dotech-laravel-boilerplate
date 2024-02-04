<?php

namespace App\Http\Controllers;

use App\Models\Master\News;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->menu = "NEWS";
        $this->url = url('news');
        $this->title = "News";
        $this->view = "master.news.";
    }

    public function index()
    {
        $this->authAction('read', 'redirect');
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

        $data = News::with('user')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        $this->authAction('read');
        if ($this->authCheckDetailAccess() !== true) return $this->authCheckDetailAccess();

        $breadcrumbs = [
            ['url' => url('/dashboard'), 'title' => 'Home'],
            ["url" => "#", "title" => "Master"],
            ['url' => $this->url, 'title' => $this->title],
            ['url' => '#', 'title' => 'Detail'],
        ];

        $data = News::with('user')->findOrFail($id);

        $data = [
            "Creator" => $data->user->name ?? "-",
            "Slug" => $data->slug ?? "-",
            "Title" => $data->title ?? "-",
            "Content" => $data->content ?? "-",
            "Image" => $data->image ?? "-",
        ];

        return view($this->view . 'detail')->with('title', $this->title)
            ->with('url', $this->url)
            ->with('title', 'Detail ' . $this->title)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('data', $data);
    }
}
