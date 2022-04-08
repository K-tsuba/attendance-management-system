<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Time;
use App\User;
use Auth;

class Time extends Model
{
    public function getLatestTime()
    {
        // return $this->where('user_id', Auth::user()->id)->latest('updated_at')->first();
        $this->where('user_id', Auth::user()->id)->latest('updated_at')->first();
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function rest_time($time)
    {
        $rest_sum = strtotime($time->rest_stop) - strtotime($time->rest_start);
        $rest_time = gmdate('H:i:s', $rest_sum);
        return $rest_time;
    }
}
