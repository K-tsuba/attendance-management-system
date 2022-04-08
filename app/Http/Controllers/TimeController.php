<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Time;
use App\User;


class TimeController extends Controller
{
    public function start_store(Request $request, Time $time)
    {
        $input = $request['status'];
        if ($input === 'start'){
            $time->user_id = Auth::user()->id;
            $time->start_time = new Carbon('now');
            // $time->study_site_id = $study_site->id;
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
            // $diff = strtotime('now') - strtotime($time->start_time);
            // $time->time = gmdate('H:i:s', $diff);
            $time->save();
            return redirect('/');
        }
    }
    public function rest_stop_store(Request $request, Time $time){
        $input = $request['status'];
        if ($input === 'rest_stop'){
            $time = $time->latest('updated_at')->first();
            $time->rest_stop = new Carbon('now');
            // $diff = strtotime('now') - strtotime($time->start_time);
            // $time->time = gmdate('H:i:s', $diff);
            $time->save();
            return redirect('/');
        }
    }
    
    public function show(Time $time)
    {
        // //先週のランキング
        // $Users = User::get();
        // $last_monday = Carbon::today()->startOfWeek()->subDay(7)->toDateString();
        // $this_monday = Carbon::today()->startOfWeek()->toDateString();
        // $week_ranking = $time->ranking($Users, $last_monday, $this_monday);
        // //先月のランキング
        // $last_month = Carbon::today()->startOfMonth()->subMonth()->toDateString();
        // $this_month = Carbon::today()->startOfMonth()->toDateString();
        // $month_ranking = $time->ranking($Users, $last_month, $this_month);
        
        // $rest_sum = strtotime($time->rest_stop) - strtotime($time->rest_start);
        // $rest_time = gmdate('H:i:s', $rest_sum);
        
        return view('times/show')->with([
            'times' => $time->get()
            // 'week_ranking' => $week_ranking,
            // 'month_ranking' => $month_ranking
        ]);
    }
}
