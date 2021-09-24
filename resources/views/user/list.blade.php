@extends('layouts.main')

@section('title','User : List')

@section('content')

<form class="form" action="{{ route('user-list')}}" method="get">

    <table>
        <tr>
            <td> <label for="term"><strong>Search</strong></label></td>
            <td class="blue"><strong>::</strong></td>
            <td><input type="text" name="term" id="term" value="{{$data['term']}}"></td>
            <td class="actions"><button class="blue-box" type="submit">Search</button> <a href="{{ route('user-list')}}"><button class="green-box">Clear</button></a></td>
        </tr>
    </table>
</form>

<nav>
    <ul>
        @can('create', \App\Models\User::class)
        <li>
            <a class="link" href="{{ route('user-create-form')}}">New User</a>
        </li>
        @endcan
    </ul>
</nav>


<table class="list">
    <tr>
        <th>E-mail</th>
        <th>Name</th>
        <th>Role</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td  class="code email" ><a href="{{ route('user-detail',['email'=> $user->email]) }}">{{$user->email}}</a></td>
        <td class="u-name">{{$user->name}}</td>
        <td class="u-name">{{$user->role}}</td>
    </tr>
    @endforeach
</table>

{{ $users->links() }}

@endsection