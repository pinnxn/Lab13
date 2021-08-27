@extends('layouts.main')

@section('title','Product : Update')

@section('content')

<form class="form" action="{{ route('product-update',['code' => $product['code']]) }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="code" value="{{$product->code}}"></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="name" value="{{$product->name}}"></td>
    </tr>
    <tr>
        <td><strong>Price</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="price" value="{{$product->price}}"></td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td class="blue">::</td>
        <td><textarea name="description" cols="30" rows="10" >{{$product->description}}</textarea></td>
    </tr>
</table>
<input type="submit" value="Update">
</form>


@endsection