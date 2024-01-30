<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Setting\Menu;
use Illuminate\Support\Facades\Route;

class MenuHelper
{
    public static function generateMenu($menus = null, $parentId = null)
    {
        $group_id = auth()->user()->group_id;
        $menus = Menu::join('group_menus', 'menus.menu_id', '=', 'group_menus.menu_id')
            ->where('group_menus.group_id', $group_id)
            ->whereNull('group_menus.deleted_at')
            ->orderBy('menus.order', 'asc')
            ->get()
            ->toArray();

        $menuHtml = '';

        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $menuHtml .= '<li class="nav-item ' . (self::hasActiveChild($menus, $menu['menu_id']) ? 'menu-open' : '') . '">';
                $menuHtml .= '<a href="' . ($menu['url'] ? url($menu['url']) : '#') . '" class="nav-link ' . (self::isActiveRoute($menu['url']) ? 'active' : '') . '">';
                $menuHtml .= '<i class="nav-icon ' . $menu['icon'] . '"></i>';
                $menuHtml .= '<p>';
                $menuHtml .= $menu['name'];

                if (self::hasChild($menus, $menu['menu_id'])) {
                    $menuHtml .= '<i class="right fas fa-angle-left"></i>';
                }

                $menuHtml .= '</p>';
                $menuHtml .= '</a>';

                if (self::hasChild($menus, $menu['menu_id'])) {
                    $menuHtml .= '<ul class="nav nav-treeview">';
                    $menuHtml .= self::generateMenu($menus, $menu['menu_id']);
                    $menuHtml .= '</ul>';
                }

                $menuHtml .= '</li>';
            }
        }

        return $menuHtml;
    }

    public static function hasChild($menus, $menuId)
    {
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $menuId) {
                return true;
            }
        }

        return false;
    }

    public static function hasActiveChild($menus, $menuId)
    {
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $menuId && self::isActiveRoute($menu['url'])) {
                return true;
            }
        }

        return false;
    }

    public static function isActiveRoute($route)
    {
        return request()->is($route);
    }
}
