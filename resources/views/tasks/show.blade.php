@extends('layouts.app')

@section('content')

    <div class="card col-md-5 m-4">
        <div class="card-header card-title d-flex justify-content-between">
            <div>{{ $task->caption }}</div>
            <div>{{ $task->getUpdatedDate() }}</div>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $task->description }}</p>
                <a href="{{url()->previous()}}" class="btn btn-secondary">Go back</a>
        </div>
    </div>


@endsection