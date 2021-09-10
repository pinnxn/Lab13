@extends('layouts.main')

@section('title','Product : Create')

@section('content')

<form class="form" action="{{ route('product-create')}}" method="post">
    @csrf
    <table>
        <tr>
            <td><strong>Code</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="code"></td>
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td><strong><label>Category</label></strong></td>
            <td class="blue">::</td>
            <td><select name="category_id">
                    <option value="select">-- Please select category --</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">[{{$category->code}}] {{$category->name}}</option>
                    @endforeach
                </select></td>
        </tr>
        <tr>
            <td><strong>Price</strong></td>
            <td class="blue">::</td>
            <td><input type="number" name="price"></td>
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            <td class="blue">::</td>
            <td><textarea name="description" cols="30" rows="10"></textarea></td>
        </tr>
    </table>
    <input type="submit" value="Create">
</form>


@endsection