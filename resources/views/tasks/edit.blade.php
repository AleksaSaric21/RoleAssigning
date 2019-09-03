@extends('layouts.app')


@section('content')

    <form class="col-md-3" method="post" action="/tasks/{{$task->id}}">
        @csrf @method('PATCH')
        <div class="form-group ">
            <label for="formGroupExampleInput">Task Caption</label>
            <input type="text" name="caption" value="{{old('caption',$task->caption)}}"
                   class="form-control" id="formGroupExampleInput">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Task Description</label>
            <textarea class="form-control" name="description"
                      id="exampleFormControlTextarea1" rows="3">{{ old('description',$task->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection