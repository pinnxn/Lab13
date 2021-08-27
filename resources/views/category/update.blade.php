@extends('layouts.main')

@section('title','Category : Update')

@section('content')

<form class="form" action="{{ route('category-update',['code' => $category['code']]) }}" method="post">
    @csrf
<table>
    <tr>
        <td><strong>Code</strong></td>
        <td class="blue">::</td>
        <td><input class="font" type="text" name="code" value="{{$category->code}}"></td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td><input type="text" name="name" value="{{$category->name}}"></td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td class="blue">::</td>
        <td><textarea name="description" cols="30" rows="10" >{{$category->description}}</textarea></td>
    </tr>
</table>
<input type="submit" value="Update">
</form>


@endsection