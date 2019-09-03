@extends('layouts.app')

@section('content')

    @foreach($tasks as $task)
    @if ((Auth::guest() && !$task->isPublished))
        @continue; @endcan
    @if (Auth::user() && $task->doesntBelongToUserAndNotPublished())
        @continue; @endcan
    <div class="card col-md-5 m-4 {{ !$task->isPublished ? 'not-published' : ''}}" >
        <div class="card-header card-title d-flex justify-content-between">
            {{ $task->caption }}

            <div>
                {{$task->getUpdatedDate().' by '.$task->user->name}}
            </div>


        </div>
        <div class="card-body">
            <p class="card-text">{{ $task->description }}</p>
            <div class="d-flex justify-content-between align-items-center">

                <a href="/tasks/{{$task->id}}" class="btn btn-secondary">See post</a>


                @can('update',$task)
                    <a href="/tasks/{{$task->id}}/edit" class="btn btn-secondary">Edit task</a>
                @endcan
                @can('delete',$task)
                    <form action="/tasks/{{$task->id}}" method="post">
                            @csrf @method('DELETE')
                            <input type="submit" class="btn-secondary" value="Delete post">
                        </form>
                @endcan

            </div>
        </div>
    </div>

        @can('publish',$task)
        <div class="m-4">
            <form action="/tasks/publish/{{$task->id}}" method="post">
                @csrf @method('POST')
                <input type="submit" class="btn-primary" value="Publish">
            </form>
        </div>
        @endcan
    @endforeach
@endsection
