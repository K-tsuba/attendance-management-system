@extends('layouts.app')
@section('content')
<body>
    <div class="container">
        <h1>勤務時間管理</h1>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Work Time</th>
                    <th>Rest Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($times as $time)
                    <tr>
                        @if(isset( $time ))
                        <td>{{ $time->user->name }}</td>
                        @else
                        <td>Name</td>
                        @endif
                        <td>{{ $time->updated_at }}</td>
                        <td>{{ $time->time }}</td>
                        <td>{{ $time->rest_time($time) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
@endsection