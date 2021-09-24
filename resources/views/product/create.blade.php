@extends('layouts.main')

@section('title','Product : Create')

@section('content')

<form class="form" action="{{ route('product-create')}}" method="post">
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
            <td><strong><label>Category</label></strong></td>
            <td class="blue">::</td>
            <td><select name="category_id" required>
                    <option value="select">-- Please select category --</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}"{{ ($category->id ===old('category')) ? ' selected' : '' }} >[{{$category->code}}] {{$category->name}}</option>
                    @endforeach
                </select></td>
        </tr>
        <tr>
            <td><strong>Price</strong></td>
            <td class="blue">::</td>
            <td><input type="number" name="price" value="{{old('price')}}"></td>
        </tr>
        <tr>
            <td><strong>Description</strong></td>
            <td class="blue">::</td>
            <td><textarea name="description" cols="30" rows="10" required>{{old('description')}}</textarea></td>
        </tr>
    </table>
    <input type="submit" value="Create">
</form>


@endsection