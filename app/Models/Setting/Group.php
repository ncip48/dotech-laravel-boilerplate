<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $primaryKey = 'group_id';

    protected $fillable = [
        'code',
        'name',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'group_id', 'group_id');
    }

    public function groupMenus()
    {
        return $this->hasMany('App\Models\Setting\GroupMenu', 'group_id', 'group_id');
    }
}
