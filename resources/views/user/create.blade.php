@extends('layouts.main')

@section('title','User : Create')

@section('content')

<form class="form" action="{{ route('user-create')}}" method="post">
    @csrf
    <table>
        <tr>
            <td><strong>Email</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td><strong>Password</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="password"></td>
        </tr>
        <tr>
            <td><strong><label>Rloe</label></strong></td>
            <td class="blue">::</td>
            <td><select name="role">
                    <option value="select">-- Please select category --</option>
                    @foreach ($roles as $role)
                    <option value="{{$role}}">[{{$role}}]</option>
                    @endforeach
                </select></td>
        </tr>
</table>

    <input type="submit" value="Create">
</form>


@endsection