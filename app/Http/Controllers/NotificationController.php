<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function add(Request $request)
    {
        $notification = new Notification();
        $notification->title = $request->_title;
        $notification->text = $request->_text;
        $notification->group_id = $request->_group_id;
        //dd($request->_end_at);
        //$time = strtotime($request->_end_at);
        //$newformat = date('Y-m-d H:m:s', $time);
        //dd($newformat);
        $notification->end_at = '2017-12-15 22:04:42';

        $notification->save();

        return response()->json($notification, 200);
    }

    public function update(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->group_id = $request->group_id;
        $notification->end_at = '2017-12-15 22:04:42';

        $notification->save();

        return response()->json($notification, 200);
    }

    public function get_from_groups($id)
    {
        $notifications = Notification::where('group_id', $id)->get();
        return response()->json($notifications, 200);
    }

    public function single($id)
    {
        $notification = Notification::find($id);
        return response()->json($notification, 200);
    }

    public function destroy(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->delete();
        return response()->json(true, 200);
    }
}
