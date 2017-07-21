@extends('layouts.app')

@section('content')
	 <form action="{{route('role.store')}}" method="post" accept-charset="utf-8" id="frmData">
     {{csrf_field()}}
        	<div class="form-group">
        		<label for="name">Role Name</label>
        		<input type="text" name="name" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="display_name">Display Name</label>
        		<input type="text" name="display_name" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="description">Description</label>
        		<input type="text" name="description" class="form-control">
        	</div>
        	<div class="form-group">
        	@foreach ($permissions as $permission)
        		<input type="checkbox" name="permission[]" value="{{$permission->id}}">{{$permission->name}} <br />
        	@endforeach
        	</div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
            </div>  
        </form>
@endsection

