@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<hr>
                    <a href="{{url('teachers')}}" class="btn btn-success">TEACHERS</a>
                    <a href="{{url('teacher/add')}}" class="btn btn-info">ADD TEACHER</a>
                    <a href="{{url('teacher/assign')}}" class="btn btn-primary">ASSIGN CLASS</a>
                    <a href="{{url('teacher/attendance')}}" class="btn btn-warning">ATTENDANCE</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
