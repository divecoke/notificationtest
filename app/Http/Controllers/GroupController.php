<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function add(Request $request)
    {
        //dd($request->group['_title']);
        $qr_code = $request->group['_qr_code'];
        //dd($request->user_id);
        $user = User::find($request->user_id);
        $url = public_path() . '/images/qr_codes/' . $qr_code . '.jpg';
        file_put_contents($url, file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . $qr_code));
        $group = new Group();
        $group->title = $request->group['_title'];
        $group->group_code = $request->group['_group_code'];
        $group->qr_code = $qr_code;
        $group->save();
        $group->users()->attach($user->id, ['role_id' => 1]); // 1 - admin

        return response()->json($group, 200);

    }

    public function join(Request $request)
    {
        $group = null;
        $code = $request->code;
        $qr_code = $request->qr_code;
        if ($code != null) {
            $group = Group::where('group_code', $code)->first();
        } else if ($qr_code != null) {
            $group = Group::where('qr_code', $qr_code)->first();
        } else {
            return response()->json(['error' => 'Please fill or scan code!']);
        }
        if ($group != null) {
            $exists = $group->users->contains($request->user_id);
            //dd($exists);
            if (!$exists) {
                $group->users()->attach($request->user_id, ['role_id' => 2]); // 2 - member
            } else {
                return response()->json(['error' => 'You are already in this group']);
            }

        } else {
            return response()->json(['error' => 'Group does not exist!', 401]);
        }


        return response()->json('Successfully joined', 200);
    }

    public function update(Request $request)
    {
        $group = Group::find($request->id);
        $group->title = $request->title;
        $group->group_code = $request->group_code;
        $group->qr_code = $request->qr_code;
        $group->save();

        return response()->json($group, 200);
    }

    public function all()
    {
        $groups = Group::all();
        return response()->json($groups, 200);
    }

    public function fetchUserGroups($user_id)
    {
        $user = User::find($user_id);
        //dd($user->groups);
        return response()->json($user->groups, 200);
    }

    public function single($id)
    {
        $group = Group::find($id);
        return response()->json($group, 200);
    }

    public function destroy(Request $request)
    {
        $group = Group::find($request->id);
        $group->delete();
        return response()->json('Deleted', 200);
    }

}
