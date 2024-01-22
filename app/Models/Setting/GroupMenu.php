<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
