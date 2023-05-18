<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleProfesional = Role::create(['name' => 'profesional']);
        $roleAdministrativo = Role::create(['name' => 'administrativo']);
        
        Permission::create(['name' => 'user'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'user.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'user.update'])->syncRoles([$roleAdmin]);
    }
}
