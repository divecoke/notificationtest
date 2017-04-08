<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->OS = $request->OS;
        $user->remember_token = $request->remember_token;
        $user->save();
        return response()->json($user, 200);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->OS = $request->OS;
        $user->save();

        return response()->json($user, 200);
    }
    public function all()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function single($id)
    {
        $user = User::find($id);
        return response()->json($user, 200);
    }
    public function destroy(Request $request) {
        $user = User::find($request->id);
        $user->delete();
        return response()->json('Deleted', 200);
    }
}
