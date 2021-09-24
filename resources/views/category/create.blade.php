@extends('layouts.main')

@section('title','Category : Create')

@section('content')

<form class="form" action="{{ route('category-create')}}" method="post">
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
        <td><input type="text" name="name" value="{{old('code')}}" required ></td>
    </tr>
    <td><strong>Description</strong></td>
        <td class="blue">::</td>
        <td><textarea name="description" cols="30" rows="10"  required>{{old('description')}}</textarea></td>
</table>
<input type="submit" value="Create">
</form>


@endsection