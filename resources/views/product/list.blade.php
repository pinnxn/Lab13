@extends('layouts.main')

@section('title','Product : List')

@section('content')

<form class="form" action="{{ route('product-list')}}" method="grt">
    

    <table>
        <tr>
            <td> <label for="term">Search</label></td>
            <td>::</td>
            <td><input type="text" name="term" id="term" value="{{$data['term']}}"></td>
        </tr>
        <tr>
            <td> <label for="minPrice">Min Price</label></td>
            <td>::</td>
            <td><input type="text" name="minPrice" id="minPrice" value="{{$data['minPrice']}}"></td>
        </tr>
        <tr>
            <td> <label for="maxPrice">Max Price</label></td>
            <td>::</td>
            <td><input type="text" name="maxPrice" id="maxPrice" value="{{$data['maxPrice']}}"></td>
        </tr>
</table>
</form>
<div class="actions">
    <button type="submit">Search</button>

    <a href="{{ route('product-list')}}">
        <button>Clear</button>
    </a>
    </div>


<a class="link" href="{{ route('product-create-form')}}">New Product</a>

<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td class="code"><a href="{{ route('product-detail',['code'=> $product->code]) }}">{{$product->code}}</a></td>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
    </tr>
    @endforeach
</table>

{{ $products->links() }}

@endsection