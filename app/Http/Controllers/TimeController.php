<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Time;
use App\User;


class TimeController extends Controller
{
    public function index () {
        return view('times.index');
    }
    public function start_store(Request $request, Time $time)
    {
        $input = $request['status'];
        if ($input === 'start'){
            $time->user_id = Auth::user()->id;
            $time->start_time = new Carbon('now');
            $time->save();
            return redirect('/');
        } 
    }
    public function stop_store(Request $request, Time $time){
        $input = $request['status'];
        if ($input === 'stop'){
            $time = $time->latest('updated_at')->first();
            $time->stop_time = new Carbon('now');
            $diff = (strtotime('now') - strtotime($time->start_time)) - (strtotime($time -> rest_stop) - strtotime($time -> rest_start));
            $time->time = gmdate('H:i:s', $diff);
            $time->save();
            return redirect('/');
        }
    }
    public function rest_start_store(Request $request, Time $time){
        $input = $request['status'];
        if ($input === 'rest_start'){
            $time = $time->latest('updated_at')->first();
            $time->rest_start = new Carbon('now');
            $time->save();
            return redirect('/');
        }
    }
    public function rest_stop_store(Request $request, Time $time){
        $input = $request['status'];
        if ($input === 'rest_stop'){
            $time = $time->latest('updated_at')->first();
            $time->rest_stop = new Carbon('now');
            $time->save();
            return redirect('/');
        }
    }
    
    public function show(Time $time)
    {
        return view('times/show')->with([
            'times' => $time->get()
        ]);
    }
}
