@extends('layouts.app')
@section('content')
	@if (Session::has('success'))
        <div class="alert alert-success">
            <span>
                {{Session::get('success')}}
            </span>
        </div>
    @endif
	<table class="table table-stripped table-bordered">
		<div class="form-group">
		<caption><h1>Student Management &nbsp;<a href="{{route('student.create')}}" class="btn btn-primary">Create</a></h1>
		</caption>
		</div>
		<thead>
			<tr>
				<th>id</th>
				<th>image</th>
				<th>student name</th>
				<th>contact</th>
				<th>course</th>
				<th>actions</th>
			</tr>
		</thead>
		@forelse ($students as $student)
			<tr>
				<td>{{$student->id}}</td>
				<td><img src="{{asset('storage/photo/'.$student->image)}}" alt=".." width="100px" height="70px"></td>
				<td>{{$student->name}}</td>
				<td>{{$student->contact}}</td>
				<td>{{$student->course}}</td>
				<td>
				{{-- <button type="button" class="btn btn-info">Edit</button> --}}
				<a href="{{route('student.edit',$student->id)}}" class="btn btn-info btn-sm">Edit</a>
				<form action="{{route('student.destroy',$student->id)}}" method="post">
				{{csrf_field()}}
				{{method_field('DELETE')}}
					<button type="submit" class="btn btn-warning btn-sm">Delete</button>
				</form>
				</td>
			</tr>
		@empty
			<tr>
				<td>Student is empty</td>
			</tr>
		@endforelse
		<tbody>
			
		</tbody>
	</table>
	{{ $students->render() }}
@endsection