@extends('layouts.main')

@section('title','Shop : Create')

@section('content')

<form class="form" action="{{ route('shop-create')}}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="code" value="{{old('code')}}" required></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="name" value="{{old('name')}}" required></td>
    </tr>
    <tr>
        <td><strong>Owner</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="owner" value="{{old('owner')}}" required></td>
    </tr>
    <tr>
        <td><strong>Latitude</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="latitude" value="{{old('latitude')}}" required ></td>
    </tr>
    <tr>
        <td><strong>Longitude</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="longitude" value="{{old('longitude')}}" required ></td>
    </tr>
    <tr>
        <td><strong>Address</strong></td>
        <td class="blue">::</td>
        <td><textarea name="address" cols="30" rows="10" required>{{old('address')}}</textarea></td>
    </tr>
</table>
<input type="submit" value="Create">
</form>


@endsection