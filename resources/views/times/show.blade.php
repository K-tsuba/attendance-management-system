@extends('layouts.app')
@section('content')
<body>
    <h1>勤務時間管理画面</h1>
    @foreach ($times as $time)
        <div>
            @if(isset( $time ))
            
            <p>User Name : {{ $time->user->name }}</p>
            @else
            <p>User Name : name</p>
            @endif
        </div>
        <div>
            <p>DATE : {{ $time->updated_at }}</p>
        </div>
        <div>
            <p>Work Time : {{ $time->time }}</p>
        </div>
        <div>
            <p>Rest Time : {{ $time->rest_time($time) }}</p>
        </div>
    @endforeach
</body>
@endsection