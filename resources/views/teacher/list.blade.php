@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">TEACHERS <a href="{{url('home')}}">back</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Classes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = count($data);
                            @endphp
                            @for ($i = 0; $i < $count; $i++)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{$data[$i]->name}}</td>
                                    <td>{{$data[$i]->subject}}</td>
                                    <td>{{$data[$i]->email}}</td>
                                    <td>{{$data[$i]->phone}}</td>
                                    <td>{{$data[$i]->allclasses}}</td>
                                    <td><a href="{{url('teacher')}}/{{$data[$i]->id}}/edit">EDIT</a> | <a href="{{url('teacher')}}/{{$data[$i]->id}}/delete">DELETE</a></td>
                                </tr>
                            @endfor
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
