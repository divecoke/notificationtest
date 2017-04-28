<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function get()
    {
        $roles = Role::all();
        return response()->json($roles, 200);
    }
}
