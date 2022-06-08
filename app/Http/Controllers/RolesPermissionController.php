<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesPermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('backend.roles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
        ]);

        Role::create(['name' => $request->input('role')]);
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
}
