<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupMenu extends Model
{
    use HasFactory;

    protected $table = 'group_menus';

    protected $primaryKey = 'group_menu_id';

    protected $fillable = [
        'group_id',
        'menu_id',
        'create',
        'read',
        'update',
        'delete',
    ];

    public static function getMenuMap($group_id, $tag = '', $parent_id = null)
    {
        $map = DB::table('menus AS m')
            ->selectRaw('m.menu_id,m.url, m.name as menu_name, m.level, m.order, (SELECT COUNT(*) FROM menus mm WHERE mm.parent_id = m.menu_id) as sub, gm.create, gm.read, gm.update, gm.delete')
            ->leftJoin('group_menus AS gm', function ($join) use ($group_id) {
                $join->on('m.menu_id', '=', 'gm.menu_id')
                    ->where('gm.group_id', '=', $group_id)
                    ->whereNull('gm.deleted_at');
            })
            ->where('m.is_active', '=', 1)
            ->orderBy('m.order');

        if (empty($parent_id)) {
            $map->where(function ($query) {
                $query->whereNull('m.parent_id')
                    ->orWhere('m.level', '=', 1);
            });
        } else {
            $map->where(function ($query) use ($parent_id) {
                $query->where('m.parent_id', '=', $parent_id)
                    ->where('m.level', '>', 1);
            });
        }

        $data = $map->get();

        foreach ($data as $d) {
            if (empty($d->level == 2)) {
                $tag .= '<tr><td><span class="ml-' . $d->level . ' font-weight-bold">' . $d->menu_name . '</span></td>' .
                    // '<td class="text-center pr-2">' . strtolower($d->menu_scope) . '</td>' .
                    '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="r_act" name="' . $d->menu_id . '[read]" value="1" type="checkbox" id="r_' . $d->menu_id . '"  ' . (($d->read) ? 'checked' : '') . '><label for="r_' . $d->menu_id . '"></label></div></td>' .
                    '<td class="text-center pr-2">-</td>' .
                    '<td class="text-center pr-2">-</td>' .
                    '<td class="text-center pr-2">-</td>' .
                    // '<td class="text-center pr-2">-</td>' .
                    '</tr>';
            } else {
                $tag .= '<tr><td><span class="ml-' . $d->level . '">' . $d->menu_name . '</span></td>' .
                    // '<td class="text-center pr-2">' . strtolower($d->menu_scope) . '</td>' .
                    '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="r_act" name="' . $d->menu_id . '[read]" value="1" type="checkbox" id="r_' . $d->menu_id . '"  ' . (($d->read) ? 'checked' : '') . '><label for="r_' . $d->menu_id . '"></label></div></td>' .
                    '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="c_act" name="' . $d->menu_id . '[create]" value="1" type="checkbox" id="c_' . $d->menu_id . '"  ' . (($d->create) ? 'checked' : '') . '><label for="c_' . $d->menu_id . '"></label></div></td>' .
                    '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="u_act" name="' . $d->menu_id . '[update]" value="1" type="checkbox" id="u_' . $d->menu_id . '"  ' . (($d->update) ? 'checked' : '') . '><label for="u_' . $d->menu_id . '"></label></div></td>' .
                    '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="d_act" name="' . $d->menu_id . '[delete]" value="1" type="checkbox" id="d_' . $d->menu_id . '"  ' . (($d->delete) ? 'checked' : '') . '><label for="d_' . $d->menu_id . '"></label></div></td>' .
                    // '<td class="text-center pr-2"><div class="icheck-success d-inline"><input class="all_line" value="' . $d->menu_id . '" type="checkbox" id="line_' . $d->menu_id . '"><label for="line_' . $d->menu_id . '"></label></div></td>' .
                    '</tr>';
            }

            $tag = self::getMenuMap($group_id, $tag, $d->menu_id);
        }
        return $tag;
    }

    public static function setGroupMenu($group_id, $request)
    {
        $menu = $request->except(['_token', '_method', 'all_c', 'all_r', 'all_u', 'all_d']);

        // $data['deleted_by'] = Auth::user()->user_id;
        $data['deleted_at'] = date('Y-m-d H:i:s');

        self::where('group_id', $group_id)->update($data);

        if (!empty($menu) && is_array($menu)) {
            foreach ($menu as $menu_id => $act) {
                self::updateOrInsert(
                    ['group_id' => $group_id, 'menu_id' => $menu_id],
                    [
                        'create' => isset($act['create']) ? 1 : 0,
                        'read' => isset($act['read']) ? 1 : 0,
                        'update' => isset($act['update']) ? 1 : 0,
                        'delete' => isset($act['delete']) ? 1 : 0,
                        'deleted_at' => null,
                    ]
                );
            }
        }
        return true;
    }
}
