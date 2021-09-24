@extends('layouts.main')

@section('title','User : Update')

@section('content')

<form class="form" action="{{ route('user-update',['email' => $user['email']]) }}" method="post">
    @csrf
    <table>
        <tr>
            <td><strong>Email</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="email" value="{{old('email',$user->email)}}"></td>
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name" value="{{old('name', $user->name)}}"></td>
        </tr>
        <tr>
            <td><strong>Password</strong></td>
            <td class="blue">::</td>
            <td><input type="password" name="password" placeholder="Leave blank if you don't need to edit"></td>
        </tr>
        <tr>
            <td><strong><label>Rloe</label></strong></td>
            <td class="blue">::</td>
            <td><select name="role">
                    <option value="select">-- Please select category --</option>
                    @foreach ($roles as $role)
                    <option @if($role==$user->role) selected @endif value="{{$role}}"{{($role===old('role')) ? ' selected' : ''}}>[{{$role}}]</option>
                    @endforeach
                </select></td>
        </tr>
    </table>
    <input type="submit" value="Update">
</form>


@endsection