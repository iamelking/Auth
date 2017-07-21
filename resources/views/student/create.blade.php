@extends('layouts.app')

@section('content')
    <form action="{{route('student.store')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8" id="frmData">
        {{csrf_field()}}
        <div class="col-md-3">  
        <img src="{{asset('storage/photo/no_avatar.jpg')}}" alt="no image" id="imgView" width="200px" height="200px" class="thumbnail">
        </div>
        <div class="col-md-9">
            {{-- <div class="form-group">
                <label for="name">Student image</label> --}}
                {{-- <input type="file" name="img" class="form-control" id="img"> --}}
            {{-- </div>  --}}
            <div class="form-group {{$errors->has('name') ? "has-error" : ""}}">
                <label for="name">Student Name</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('contact') ? "has-error" : ""}}">
                <label for="contact">contact</label>
                <input type="text" name="contact" class="form-control" value="{{old('contact')}}">
                @if ($errors->has('contact'))
                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                @endif
            </div>
            <div class="form-group {{$errors->has('course') ? "has-error" : ""}}">
                <label for="course">course</label>
                <input type="text" name="course" class="form-control" value="{{old('course')}}">
                @if ($errors->has('course'))
                    <span class="text-danger">{{ $errors->first('course') }}</span>
                @endif
            </div>
            <div class="form-group"> 
                 <input type="file" name="img" id="img" class="form-control" value="{{old('img')}}">
            </div> 
            <div class="form-group"> 
                <a href="{{route('student.index')}}" class="btn btn-primary"><span class="glyphicons glyphicons-unshare"></span>Back</a>
                <button type="submit" class="btn btn-primary pull-right" id="btnSave">Save changes</button>
            </div>   
        </div>
    </form>
<!--block of error-->

{{--  @if (count($errors)>0)
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
        @endforeach
        </ul>
            
        </div>
@endif --}}


@endsection
@push('scripts')
<script type="text/javascript" charset="utf-8" async defer>
    $('#img').on('change',function(e){
        var fileinput = this;
        if (fileinput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){

                $('#imgView').attr('src',e.target.result);

            }
            reader.readAsDataURL(fileinput.files[0]);
        }else{
            $('#imgView').attr('src','{{asset('storage/no_avatar.jpg')}}');
        }
    });
</script>
@endpush


