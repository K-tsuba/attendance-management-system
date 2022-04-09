<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Time;

class UserController extends Controller
{
    public function index(Time $time)
    {
        $today = Carbon::today();
        $time = $time->whereDate('updated_at', $today)->get();
        return view('/users/index')->with([
            'times' => $time
        ]);
    }
}
