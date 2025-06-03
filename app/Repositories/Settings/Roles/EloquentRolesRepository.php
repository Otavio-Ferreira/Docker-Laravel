<?php

namespace App\Repositories\Settings\Roles;

use Spatie\Permission\Models\Role;

class EloquentRolesRepository implements RolesRepository
{
    public function getAll(){
        return Role::get();
    }

}
