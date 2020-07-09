@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">TEACHERS attendance <a href="{{url('home')}}">back</a></div>

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
                                <th>Status</th>
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
                                    <td>
                                        @switch($data[$i]->status)
                                            @case(1)
                                            ON
                                                
                                                @break
                                            @case(0)
                                                OFF
                                                @break
                                            @default
                                            ON | OFF
                                        @endswitch
                                        </td>
                                    <td>
                                        @if ($data[$i]->status)
                                            
                                        @else
                                        <a href="{{url('attendance')}}/{{$data[$i]->id}}?status=on">ON</a> | 
                                        <a href="{{url('attendance')}}/{{$data[$i]->id}}?status=off">OFF</a>
                                            
                                        @endif
                                        
                                    </td>
                                        
                                       
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
