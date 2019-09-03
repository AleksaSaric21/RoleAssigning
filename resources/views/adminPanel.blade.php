@extends('layouts.app')

@section('content')



        <table cellpadding="25px" style="margin: 0 auto; padding: 20px;">
            <caption>Assign role by checking the box</caption>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Moderator</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if ($user->hasRole('Admin')) @continue
                @endif
                <tr>


                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        <form action="/admin/toggleModeratorRole/{{$user->id}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" onchange="this.form.submit()"
                               {{$user->hasRole('Moderator')? 'checked' : ''}}
                            name="toggleModerator">
                        </form>
                    </td>
                    <td>
                        <form action="/admin/toggleAuthorRole/{{$user->id}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" onchange="this.form.submit()"
                               {{$user->hasRole('Author')? 'checked' : ''}}
                            name="toggleAuthor">
                        </form>
                    </td>



                </tr>
            @endforeach
            </tbody>
        </table>




@endsection
