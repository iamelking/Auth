@extends('layouts.app')

@section('content')
	<table class="table table-stripped table-bordered">
		<caption><h1>Permission Lists</caption>
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>display name</th>
				<th>description</th>
			</tr>
		</thead>
		@forelse ($perms as $key =>  $perm)
			<tr>
				<td>{{$perm->id}}</td>
				<td>{{$perm->name}}</td>
				<td>{{$perm->display_name}}</td>
				<td>{{$perm->description}}</td>
			</tr>
		@empty
			<tr>
				<td>Permission  is empty</td>
			</tr>
		@endforelse
		<tbody>
			
		</tbody>
	</table>
@endsection