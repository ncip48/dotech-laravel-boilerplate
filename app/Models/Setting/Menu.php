<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'code',
        'name',
        'url',
        'level',
        'order',
        'parent_id',
        'tag',
        'icon',
        'is_active',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\Setting\Menu', 'parent_id', 'menu_id');
    }
}
