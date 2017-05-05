<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_groups')->withTimestamps()->withPivot('role_id');
    }
    public function userss($id)
    {
        return $this->belongsToMany('App\User', 'users_groups')->withTimestamps()->withPivot('role_id')->where('user_id', $id);
    }

}
