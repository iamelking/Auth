@extends('layouts.app')

@section('content')
	@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif
	<table class="table table-stripped table-bordered">
		<caption><h1>User Management &nbsp;<a href="{{route('user.create')}}" class="btn btn-primary">Add new</a></h1></caption>	
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>Emal</th>
				<th>Roles</th>
				<th>actions</th>
			</tr>
		</thead>
		@forelse ($users as $key => $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>
					@if(!empty($user->roles))
						@foreach($user->roles as $v)
							<label class="label label-success">{{ $v->display_name }}</label>
						@endforeach
					@endif
				</td>
				{{-- <td>{{$user->updated_at}}</td> --}}
				<td>
				{{-- <button type="button" class="btn btn-info">Edit</button> --}}
				<a href="{{route('user.edit',$user->id)}}" class="btn btn-info btn-sm">Edit</a>
				<form action="{{route('user.destroy',$user->id)}}" method="POST" accept-charset="utf-8">
				{{csrf_field()}}
				{{method_field('DELETE')}}
					<button type="submit" class="btn btn-warning btn-sm" value="Delete">Delete</button>
				</form>
				</td>
			</tr>
		@empty
			<tr>
				<td>no users</td>
			</tr>
		@endforelse
		<tbody>
			
		</tbody>
	</table>
@endsection

{{-- @section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="mdlData">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New User</h4>
      </div>
      <div class="modal-body">
        <form accept-charset="utf-8" id="frmData">
        	<div class="form-group">
        		<label for="name">Name</label>
        		<input type="text" name="name" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="email">Email</label>
        		<input type="text" name="email" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="password">Password</label>
        		<input type="text" name="password" class="form-control">
        	</div>
        	<div class="form-group">
        		<label for="password_confirmation">Confirm Password</label>
        		<input type="text" name="password_confirmation" class="form-control">
        	</div>
        	<div class="form-group">
        	@foreach ($roles as $role)
        		<input type="checkbox" name="role[]" value="{{$role->id}}">{{$role->name}} <br />
        	@endforeach
        	</div>
        
	</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="btnSave">Save changes</button>
	      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push('scripts')
<script  type="text/javascript" charset="utf-8" async defer>
$('#btnCreate').click(function(e){
	$('#mdlData').modal('show');
});

$('#btnSave').click(function(e){
	var url = '{{route('user.store')}}';
	var frm = $('#frmData');
	$.ajax({
		url : url,
		type: 'post',
		data : frm.serialize(),
		dataType: 'json',
		success:function(data){
			console.log(data);
		}
	});
});

</script> --}}
{{-- @endpush --}}