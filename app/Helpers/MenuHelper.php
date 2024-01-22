<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class MenuHelper
{
    public static function generateMenu($menus, $parentId = null)
    {
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
