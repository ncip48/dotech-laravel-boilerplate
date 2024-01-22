<?php

namespace App\Http\Controllers;

use App\Models\Setting\GroupMenu;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

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

    public function getUserAccess()
    {
        $group_id = Auth::user()->group_id;
        $db = GroupMenu::leftJoin('menus', 'menus.menu_id', '=', 'group_menus.menu_id')
            ->where('group_menus.group_id', $group_id)
            ->where('menus.is_active', 1)
            ->whereNull('menus.deleted_at')
            ->orderBy('menus.order', 'asc');

        $data = [];
        foreach ($db->get() as $key => $value) {
            $data[strtoupper($value->code)] = [
                'create' => $value->create,
                'read' => $value->read,
                'update' => $value->update,
                'delete' => $value->delete,
            ];
        }

        return $data;
    }

    public function authAccess()
    {
        $userAccess = $this->getUserAccess();
        // dd($userAccess);
        $access = (isset($userAccess[strtoupper($this->menu)]) ? $userAccess[strtoupper($this->menu)] : ['create' => 0, 'read' => 0, 'update' => 0, 'delete' => 0]);
        $crud   = ['create' => 'create', 'read' => 'read', 'update' => 'update', 'delete' => 'delete'];
        $res    = [];
        foreach ($access as $k => $v) {
            $res[$crud[$k]] = (bool) $v;
        }
        return (object) $res;
    }
}
