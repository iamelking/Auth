@extends('layouts.app')

@section('content')
	 <form action="{{route('role.update',$roles->id)}}" method="post" accept-charset="utf-8" id="frmData">
     {{csrf_field()}}
     {{method_field('PATCH')}}
        	<div class="form-group">
        		<label for="name">Role Name</label>
        		<input type="text" name="name" class="form-control" value="{{old('name',$roles->name)}}">
        	</div>
        	<div class="form-group">
        		<label for="display_name">Display Name</label>
        		<input type="text" name="display_name" class="form-control" value="{{old('display_name',$roles->display_name)}}">
        	</div>
        	<div class="form-group">
        		<label for="description">Description</label>
        		<input type="text" name="description" class="form-control" value="{{old('description',$roles->description)}}">
        	</div>
        	<div class="form-group">
        	@foreach ($permissions as $permission)
        		<input type="checkbox" {{in_array($permission->id,$role_permissions)? "checked" :""}} name="permission[]" value="{{$permission->id}}">{{$permission->name}} <br />

        	@endforeach

        	</div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
            </div>  
        </form>
@endsection

