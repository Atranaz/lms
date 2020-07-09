@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">UPDATE TEACHER DETAILS <a href="{{url('teachers')}}">back</a></div>

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
                    <form action="{{url('teacher')}}/{{$teacher->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="name">Full Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{$teacher->name}}" required>
                          @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $name }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{$teacher->subject}}" required>
                            @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $subject }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{$teacher->email}}" required>
                     
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$teacher->phone}}" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $phone }}</strong>
                            </span>
                          @enderror
                        </div>                          
                        
                        {{-- <div class="form-group">
                            @php                                
                                $set = explode(',', $teacher->allclasses);
                                print_r($set);
                            @endphp
                          <label for="classes">Assign Classes</label>
                          <select multiple class="form-control" name="classes[]" id="classes">
                            <option value="1">Class One</option>
                            <option value="2">Class Two</option>
                            <option value="3">Class Thress</option>
                          </select>
                        </div> --}}
                        <div class="form-group">
                            <input type="submit" value="EDIT" name="updateteacher" class="btn btn-primary btn-block">
                          </div>
                       
                      </form>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
