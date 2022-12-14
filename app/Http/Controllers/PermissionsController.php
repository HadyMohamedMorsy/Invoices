<?php

namespace App\Http\Controllers;

use App\Models\permissions;
use App\Models\roles;
use Illuminate\Http\Request;

use App\Http\Requests\permissionsRoles;


class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = permissions::all();
        return view('permissions.permission' , compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rollers = roles::all();
        return view('permissions.create' , compact('rollers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(permissionsRoles $request)
    {
        permissions::create([
            'role_id' => $request->role_id,
            'permissions' => json_encode($request->permission) 
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit(permissions $permissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permissions $permissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(permissions $permissions)
    {
        //
    }
}
