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
    <div>
        <p>通知を送る</p>
        <form action="" method="post">
            @csrf
            <div>
                <p>送信相手</p>
                <select id="">
                    <option selected>送信相手</option>
                    @foreach($users as $value)
                    <option value="{{ $value->line_id }}" >{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <p>通知内容</p>
                <input type="text" placeholder="通知内容">
            </div>
            <div>
                <input type="submit" value="send">
            </div>
        </form>
    </div>
    <div>
        <p>誕生日の人の名前表示</p>
        <p>〇月〇日は○○さんの誕生日です</p>
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