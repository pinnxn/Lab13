@extends('layouts.main')

@section('title','User : View')

@section('content')

<nav>

    @can('update', \App\Models\User::class)
    <a href="{{ route('user-update-form',['email' => $user->email])}}">Update</a>
    @endcan

    @can('update', \App\Models\User::class)
    <a href="{{ route('user-delete',['email' => $user['email']])}}">Delete</a>
    @endcan
    <a href="{{ session()->get('bookmark.user-detail',route('user-list'))}}">&lt; Back</a>
</nav>

<table>
    <tr>
        <td><strong>E-mail</strong></td>
        <td class="blue">::</td>
        <td>{{$user->email}}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td >{{$user->name}}</td>
    </tr>
    <tr>
        <td><strong>Role</strong></td>
        <td class="blue">::</td>
        <td > [{{$user->role}}]</td>
    </tr>
</table>

@endsection