<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function add(Request $request)
    {
        $url = public_path() . '/images/qr_codes/' . $request->_qr_code . '.jpg';
        file_put_contents($url, file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . $request->_qr_code));
        $group = new Group();
        $group->title = $request->_title;
        $group->group_code = $request->_group_code;
        $group->qr_code = $request->_qr_code;
        $group->save();
        return response()->json($group, 200);
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
