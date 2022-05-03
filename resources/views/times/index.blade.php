<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>attendance</title>
    
    <style>
        .btn {
            width: 100px;
        }
    </style>
    
</head>
@extends('layouts.app')
@section('content')
<body>
    <div class="container">
        <h1 class="text-center">アルバイト先の名前</h1>
        <h2 class="text-center">ヒトコトメッセージ</h2>
        <div id="realtime"></div>
        <div class="">
            <button id="start" class="btn btn-outline-secondary">出勤</button>
            <button id="stop" class="btn btn-outline-secondary" disabled>退勤</button>
            <button id="rest_start" class="btn btn-outline-secondary" disabled>休憩開始</button>
            <button id="rest_stop" class="btn btn-outline-secondary" disabled>休憩終了</button>
        </div>    
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
            document.getElementById("start").disabled = false;
            document.getElementById("stop").disabled = true;
            document.getElementById("rest_start").disabled = true;
            document.getElementById("rest_stop").disabled = true;
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
        
        function showClock() {
            let nowTime = new Date();
            let nowHour = nowTime.getHours();
            let nowMin  = nowTime.getMinutes();
            let nowSec  = nowTime.getSeconds();
            
            
            
            let msg = "現在時刻：" + nowHour + " : " + nowMin + " : " + nowSec;
            
            const realtime = document.getElementById("realtime");
            realtime.innerHTML = msg;
            realtime.style.fontSize = '30px';
            realtime.style.marginLeft = '20px';
            
        }
        setInterval('showClock()',1000);
        
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