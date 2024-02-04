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

    private $action = "";
    protected $menu;
    protected $url;
    protected $title;
    protected $view;
    protected $actionResponse;

    protected $saveSuccessMessage = "Data has been saved successfully.";
    protected $updateSuccessMessage = "Data has been updated successfully.";
    protected $deleteSuccessMessage = "Data has been deleted successfully.";
    protected $saveFailedMessage = "Data failed to save.";
    protected $updateFailedMessage = "Data failed to update.";
    protected $deleteFailedMessage = "Data failed to delete.";

    public function showError($message)
    {
        return $this->setResponse(false, $message);
    }

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
            ->whereNull('group_menus.deleted_at')
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

    protected function authAction(string $action = 'read', string $action_response = 'default'): void
    {
        switch (strtolower($action)) {
            case 'create':
                $this->action = 'create';
                break;
            case 'update':
                $this->action = 'update';
                break;
            case 'delete':
                $this->action = 'delete';
                break;
            case 'read':
            default:
                $this->action = 'read';
                break;
        };

        $this->actionResponse = $action_response;
    }

    protected function authCheckDetailAccess()
    {
        $userAccess = $this->getUserAccess();
        if (!isset($userAccess[strtoupper($this->menu)][$this->action]) or $userAccess[strtoupper($this->menu)][$this->action] != 1) {
            switch (strtolower($this->actionResponse)) {
                case 'json':
                    return $this->setResponse(false, 'You are not authorized to perform this action.');
                    break;
                case 'redirect':
                    abort(403);
                default:
                    return $this->setResponse(false, 'You are not authorized to perform this action.');
                    break;
            }
        }
        return true;
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
