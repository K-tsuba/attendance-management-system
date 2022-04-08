@extends('layouts.app')
@section('content')
<body>
    <h1>出勤状況画面</h1>
    <div id="realtime"></div>
    
    <div>
        <p>出勤中</p>
        @foreach ($times as $time)        
            @if($time->stop_time === null && $time->rest_start === null && $time->rest_stop === null)
            <p>NAME : {{ $time->user->name }}</p>
            @elseif($time->stop_time === null && $time->rest_start !== null && $time->rest_stop !== null)
            <p>NAME : {{ $time->user->name }}</p>
            @endif
        @endforeach
    </div>
    <div>
        <p>休憩中</p>
        @foreach ($times as $time) 
            @if($time->stop_time === null && $time->rest_start !== null && $time->rest_stop === null)
            <p>NAME : {{ $time->user->name }}</p>
            @endif
        @endforeach
    </div>
    <div>
        <p>退勤中</p>
        @foreach ($times as $time) 
            @if($time->stop_time !== null)
            <p>NAME : {{ $time->user->name }}</p>
            @endif
        @endforeach
    </div>
    <script>
        function showClock() {
            let nowTime = new Date();
            let nowHour = nowTime.getHours();
            let nowMin  = nowTime.getMinutes();
            let nowSec  = nowTime.getSeconds();
            let msg = "現在時刻：" + nowHour + ":" + nowMin + ":" + nowSec;
            document.getElementById("realtime").innerHTML = msg;
        }
        setInterval('showClock()',1000);
        
        
    </script>
</body>
@endsection