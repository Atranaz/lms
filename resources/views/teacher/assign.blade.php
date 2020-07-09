@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ASSIGN CLASSES <a href="{{url('home')}}">back</a></div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{url('class_assign')}}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="teacher">Select Teacher</label>
                            <select class="form-control" name="teacher" id="teacher">
                                @foreach ($teachers as $t)
                                    <option value="{{$t['id']}}">{{$t['name']}}</option>
                                @endforeach
                            </select>
                          </div>                  
                                            
                        
                        <div class="form-group">
                          <label for="classes">Assign Classes <sup>Press CTRL button and select more than one class</sup></label>
                          <select multiple class="form-control" name="classes[]" id="classes">
                            <option value="1">Class One</option>
                            <option value="2">Class Two</option>
                            <option value="3">Class Thress</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="ASSIGN" name="saveteacher" class="btn btn-primary btn-block">
                          </div>
                       
                      </form>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
