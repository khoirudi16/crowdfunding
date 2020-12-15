<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Support\Str;

class Role extends Model
{
    use Uuid;

    protected $guarded = [];

    protected $primaryKey = 'roleid_pk';

    public function get_user_role_id()
    {
        $role = \App\Role::where('rolename', 'user')->get()->first();
        return $role->roleid_pk;
    }
}
