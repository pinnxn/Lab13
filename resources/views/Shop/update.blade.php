@extends('layouts.main')

@section('title','Shop : Update')

@section('content')

<form class="form" action="{{ route('shop-update',['code' => $shop['code']]) }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td class="blue">::</td>
        <td><input class="font" type="text" name="code" value="{{old('code',$shop->code)}}"></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="name" value="{{old('name',$shop->name)}}"></td>
    </tr>
    <tr>
        <td><strong>Owner</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="owner" value="{{old('owner',$shop->owner)}}"></td>
    </tr>
    <tr>
        <td><strong>Latitude</strong></td>
        <td class="blue">::</td>
        <td><input class="latitude" type="number" name="latitude" value="{{old('latitude',$shop->latitude)}}"></td>
    </tr>
    <tr>
        <td><strong>Longitude</strong></td>
        <td class="blue">::</td>
        <td><input class="latitude" type="number" name="longitude" value="{{old('longitude',$shop->longitude)}}"></td>
    </tr>
    <tr>
        <td><strong>Address</strong></td>
        <td class="blue">::</td>
        <td><textarea name="address" cols="30" rows="10" >{{old('address',$shop->address)}}</textarea></td>
    </tr>
</table>
<input type="submit" value="Update">
</form>


@endsection