@extends('layouts.app')

@section('content')
	 <form action="{{route('user.update',$user->id)}}" method="post" accept-charset="utf-8" id="frmData">
     {{csrf_field()}}
     {{method_field('PATCH')}}
        	<div class="form-group">
        		<label for="name">Name</label>
        		<input type="text" name="name" class="form-control" value="{{$user->name}}">
        	</div>
        	<div class="form-group">
        		<label for="email">Email</label>
        		<input type="text" name="email" class="form-control" value="{{$user->email}}">
        	</div>
        	<div class="form-group">
        		<label for="password">Password</label>
        		<input type="text" name="password" class="form-control">
        	</div>
            <div class="form-group">
                <label for="password_confirmation">Password</label>
                <input type="text" name="password_confirmation" class="form-control">
            </div>
        	<div class="form-group">
        	@foreach ($roles as $role)
        		<input type="checkbox" {{in_array($role->id,$user_roles)? "checked" :""}} name="role[]" value="{{$role->id}}">{{$role->name}} <br />
        	@endforeach

        	</div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-primary" id="btnUpdate">Save changes</button>
            </div>  
        </form>	
@endsection