<?php

namespace App\Repositories\Settings\Roles;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class EloquentRolesRepository implements RolesRepository
{
    public function getAll()
    {
        return Role::get();
    }

    public function set($user, $role)
    {
        $user->assignRole($role);
    }

    public function update($user, $role)
    {
        $user->syncRoles([$role]);
    }

    public function create($request)
    {
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->givePermissionTo([$request->permission_selected]);

        return $role;
    }

    public function updateRole($request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $selectedPermissions = $request->input('permission_selected', []);
        $role->syncPermissions($selectedPermissions);

        return $role;
    }
}
