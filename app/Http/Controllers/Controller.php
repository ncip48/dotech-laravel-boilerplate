<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $menu;
    protected $url;
    protected $title;
    protected $view;

    public function setResponse($status, $message, $data = null)
    {
        return response()->json([
            'success' => $status,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function getMenu()
    {
        return "ok";
    }
}
