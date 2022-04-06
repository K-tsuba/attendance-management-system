<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public function getLatestTime()
    {
        // return $this->where('user_id', Auth::user()->id)->latest('updated_at')->first();
        return $this->latest('updated_at')->first();
    }
}
