<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>attendance</title>
    
</head>
@extends('layouts.app')
@section('content')
<body>
    <h1>アルバイト先の名前</h1>
    <h2>ヒトコトメッセージ</h2>
    <div>現在の日にちと時刻</div>
    <div class="">
        <button id="start" class="">出勤</button>
        <button id="stop" class="" disabled>退勤</button>
        <button id="rest_start" class="" disabled>休憩開始</button>
        <button id="rest_stop" class="" disabled>休憩終了</button>
    </div>
    <script>
        
        function start_timer() {
            document.getElementById("start").disabled = true;
            document.getElementById("stop").disabled = false;
            document.getElementById("rest_start").disabled = false;
            document.getElementById("rest_stop").disabled = true;
            var request = new XMLHttpRequest();
            var token = document.getElementsByName('csrf-token').item(0).content;
            request.open('post', '/times/start_store', true);
            request.responseType = 'json';
            request.setRequestHeader('X-CSRF-Token', token);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send("status=start");
        }
        
        function hoge(event) {
            if (start_click === true) {
                event = event || window.event;
                return event.returnValue = '表示させたいメッセージ';
            }
        }
        
        if (window.addEventListener) {
            window.addEventListener('beforeunload', hoge, false);
        }
        
        function stop_timer() {
            var token = document.getElementsByName('csrf-token').item(0).content;
            var request = new XMLHttpRequest();
            request.open('post', '/times/stop_store', true);
            request.responseType = 'json';
            request.setRequestHeader('X-CSRF-Token', token);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send("status=stop");
            document.getElementById("stop").disabled = true;
        }
        
        function rest_start() {
            var token = document.getElementsByName('csrf-token').item(0).content;
            var request = new XMLHttpRequest();
            request.open('post', '/times/rest_start', true);
            request.responseType = 'json';
            request.setRequestHeader('X-CSRF-Token', token);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send("status=rest_start");
            document.getElementById("rest_start").disabled = true;
            document.getElementById("rest_stop").disabled = false;
        }
        
        function rest_stop() {
            var token = document.getElementsByName('csrf-token').item(0).content;
            var request = new XMLHttpRequest();
            request.open('post', '/times/rest_stop', true);
            request.responseType = 'json';
            request.setRequestHeader('X-CSRF-Token', token);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send("status=rest_stop");
            document.getElementById("rest_stop").disabled = true;
        }
        
        window.onload = function () {
            var start = document.getElementById('start');
            start.addEventListener('click', start_timer, false);
            var stop = document.getElementById('stop');
            stop.addEventListener('click', stop_timer, false);
            var restStart = document.getElementById('rest_start');
            restStart.addEventListener('click', rest_start, false);
            var restStop = document.getElementById('rest_stop');
            restStop.addEventListener('click', rest_stop, false);
        }; 
        
    </script>
</body>
@endsection