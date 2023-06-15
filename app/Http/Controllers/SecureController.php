<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SecureController extends Controller
{
    //
    use HasRoles;

    public function index()
    {
        $roles = Role::all();
        
        return view('role.index',compact('roles'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
         return view('role.edit',compact('role','permissions'));
    }


    public function attachRole(Permission $permission, Role $role)
    {
        
        
        $role->givePermissionTo($permission->id);
        return back()->with('success', 'Permiso agregado correctamente!');
    }

    public function detachRole(Permission $permission , Role $role)
    {
         $role->revokePermissionTo($permission->id);
         return back()->with('success', 'Permiso eliminado correctamente!');
    }

    public function createPermission()
    {
        return view('permission.create');
    }

    public function storePermission(Request $request)
    {
        $roleAdmin = Role::find(1);

        if(Permission::where('name','=',strtolower($request->name))->exists())
        {
            $permission = Permission::where('name','=',strtolower($request->name));
            dd($permission);
            // return back()->with('error', 'El permiso ya existe!');
        }else{
            Permission::create(['name' => $request->name])->syncRoles([$roleAdmin]);
            return back()->with('success', 'Permiso '.$request->name.' creado correctamente!');
        }

    }

}
