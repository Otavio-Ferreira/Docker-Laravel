<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'status' => true
        ]);

        $permissions = [
            "1" => "adicionar_grupo",
            "2" => "adicionar_usuário",
            "3" => "ver_dashboard",
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $role = Role::create([
            'name' => 'Gerente',
            'guard_name' => 'web',
        ]);

        $role->givePermissionTo([
            "ver_dashboard",
            "adicionar_grupo",
            "adicionar_usuário"
        ]);

        $user->assignRole($role);
    }
}
