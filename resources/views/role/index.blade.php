@extends('layouts.app')

@section('content')
	@if (Session::has('success'))
		<div class="alert alert-success">
			<span>{{Session::get('success')}}</span>
		</div>
	@endif
	<table class="table table-stripped table-bordered">
		<caption><h1>Role Management&nbsp;
		@permission('role-create')
		<a href="{{route('role.create')}}" class="btn btn-primary">Add new</a></h1>
		@endpermission
		</caption>		
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>display name</th>
				<th>description</th>
				<th>permissions</th>
				<th>actions</th>
			</tr>
		</thead>
		@forelse ($roles as $key =>  $role)
			<tr>
				<td>{{$role->id}}</td>
				<td>{{$role->name}}</td>
				<td>{{$role->display_name}}</td>
				{{-- <td>{{$role->permissions}}</td> --}}
				<td>{{$role->description}}</td>
				<td>
					@if(!empty($role->perms))
						@foreach($role->perms as $v)
							<label class="label label-success">{{ $v->display_name }}</label>
						@endforeach
					@endif
				</td>	
				<td>
				@permission('role-edit')
				<a href="{{route('role.edit',$role->id)}}" class="btn btn-info btn-sm">Edit</a>
				@endpermission
				@permission('role-delete')
				<form action="{{route('role.destroy',$role->id)}}" method="post">
				{{csrf_field()}}
				{{method_field('DELETE')}}
					<button type="submit" class="btn btn-warning btn-sm">Delete</button>
				</form>
				@endpermission
				</td>
			</tr>
		@empty
			<tr>
				<td>Roles is empty</td>
			</tr>
		@endforelse
		<tbody>
			
		</tbody>
	</table>
	{!! $roles->render() !!}
@endsection

{{-- @section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="mdlData">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Role</h4>
      </div>
      <div class="modal-body">
        <form accept-charset="utf-8" id="frmData">
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
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSave">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection --}}

{{-- @push('scripts')

<script type="text/javascript" charset="utf-8" async defer>
$.ajaxSetup({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$('#btnCreate').click(function(e){
	e.preventDefault();
	$('#mdlData').modal('show');
});
$('#btnSave').click(function(e){
	e.preventDefault();
	var frm = $('#frmData');
	$.ajax({
		type : 'POST',
		url : '{{route('role.store')}}',
		dataType : 'json',
		data : frm.serialize(),
		success:function(data){
			console.log(data);
		},
	});
});

</script>

@endpush --}}