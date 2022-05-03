@extends('layouts.app')
@section('content')
<body>
    <div class="container">
        <div id="realtime"></div>
        <div class="card-deck">
            <div class="card">
                <p class="card-header">出勤中</p>
                <div class="card-body">
                    @foreach ($times as $time)        
                        @if($time->stop_time === null && $time->rest_start === null && $time->rest_stop === null)
                        <p>NAME : {{ $time->user->name }}</p>
                        @elseif($time->stop_time === null && $time->rest_start !== null && $time->rest_stop !== null)
                        <p>NAME : {{ $time->user->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="card">
                <p class="card-header">休憩中</p>
                <div class="card-body">
                    @foreach ($times as $time) 
                        @if($time->stop_time === null && $time->rest_start !== null && $time->rest_stop === null)
                        <p>NAME : {{ $time->user->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="card">
                <p class="card-header">退勤中</p>
                <div class="card-body">
                    @foreach ($times as $time) 
                        @if($time->stop_time !== null)
                        <p>NAME : {{ $time->user->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>    
        </div>
        
        <div class="border p-3 mt-3">
            <h2>通知を送る</h2>
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label>送信相手</label>
                    <select class="form-control" id="" style="width: 200px;">
                        <option selected>送信相手</option>
                        @foreach($users as $value)
                        <option value="{{ $value->line_id }}" >{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>通知内容</label>
                    <input type="text" class="form-control" placeholder="通知内容">
                </div>
                <div>
                    <button class="btn btn-outline-secondary">Send</button>
                </div>
            </form>
        </div>
        <div class="card mt-3">
            <p class="card-header">誕生日の人の名前表示</p>
            <p class="card-body">〇月〇日は○○さんの誕生日です</p>
        </div>
    </div>
    <script>
        function showClock() {
            let nowTime = new Date();
            let nowHour = nowTime.getHours();
            let nowMin  = nowTime.getMinutes();
            let nowSec  = nowTime.getSeconds();
            let msg = "現在時刻：" + nowHour + ":" + nowMin + ":" + nowSec;
            const realtime = document.getElementById("realtime");
            realtime.innerHTML = msg;
            realtime.style.fontSize = '30px';
            realtime.style.marginLeft = '20px';
        }
        setInterval('showClock()',1000);
        
        
    </script>
</body>
@endsection