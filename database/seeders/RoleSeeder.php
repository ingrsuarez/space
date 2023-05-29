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
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleProfesional = Role::create(['name' => 'profesional']);
        // $roleAdministrativo = Role::create(['name' => 'administrativo']);
        $roleAdmin = Role::find(1);
        $roleProfesional = Role::find(2);
        $roleAdministrativo = Role::find(3);
        
        // Permission::create(['name' => 'user'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'user.index'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'user.edit'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'user.update'])->syncRoles([$roleAdmin]);

        // Permission::create(['name' => 'ficha'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'ficha.index'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'ficha.store'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'ficha.update'])->syncRoles([$roleProfesional]);

        // Permission::create(['name' => 'profession'])->syncRoles([$roleAdmin,$roleProfesional]);
        // Permission::create(['name' => 'profession.index'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'profession.edit'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'profession.update'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'profession.create'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'profession.store'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'profession.add'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'profession.remove'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'profession.attach'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'profession.detach'])->syncRoles([$roleProfesional]);

        // Permission::create(['name' => 'entity.create'])->syncRoles([$roleAdmin]);
        // Permission::create(['name' => 'entity.store'])->syncRoles([$roleAdmin]);
        
        // Permission::create(['name' => 'registration.list'])->syncRoles([$roleProfesional]);
        // Permission::create(['name' => 'registration.delete'])->syncRoles([$roleProfesional]);

        // $roleProfesional->givePermissionTo('registration.list'); 
        // $roleProfesional->givePermissionTo('registration.delete'); 

        Permission::create(['name' => 'institution.index']);
        Permission::create(['name' => 'institution.create']);
        Permission::create(['name' => 'institution.store']);
        Permission::create(['name' => 'institution.edit']);
        Permission::create(['name' => 'institution.update']);
        Permission::create(['name' => 'institution.show']);
        Permission::create(['name' => 'institution.attach']);
        Permission::create(['name' => 'institution.detach']);
        $roleAdmin->givePermissionTo('institution.index');
        $roleAdmin->givePermissionTo('institution.create');
        $roleAdmin->givePermissionTo('institution.store');
        $roleAdmin->givePermissionTo('institution.edit');
        $roleAdmin->givePermissionTo('institution.update');
        $roleAdmin->givePermissionTo('institution.show');
        $roleAdmin->givePermissionTo('institution.attach');
        $roleAdmin->givePermissionTo('institution.detach');
        $roleProfesional->givePermissionTo('institution.show');
        $roleProfesional->givePermissionTo('institution.attach');
        $roleProfesional->givePermissionTo('institution.detach');

        Permission::create(['name' => 'user.delete']);
        $roleAdmin->givePermissionTo('user.delete');
    }
}
