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
        // $roleAdmin = Role::find(1);
        // $roleProfesional = Role::find(2);
        // $roleAdministrativo = Role::find(3);
        Permission::create(['name' => 'user'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'user.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'user.update'])->syncRoles([$roleAdmin]);


        Permission::create(['name' => 'ficha'])->syncRoles([$roleProfesional]);
        Permission::create(['name' => 'ficha.index'])->syncRoles([$roleProfesional]);
        Permission::create(['name' => 'ficha.store'])->syncRoles([$roleProfesional]);
        Permission::create(['name' => 'ficha.update'])->syncRoles([$roleProfesional]);
    }
}
