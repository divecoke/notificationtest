<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function add(Request $request)
    {
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->group_id = $request->group_id;
        $notification->end_date = $request->end_date;
        
        $notification->save();
        
        return response()->json($notification, 200);
    }

    public function update(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->group_id = $request->group_id;
        $notification->end_date = $request->end_date;
        
        $notification->save();
        
        return response()->json($notification, 200);
    }

    public function get_from_groups(Request $request)
    {
        $notifications = Notification::where('group_id', $request->id);
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
