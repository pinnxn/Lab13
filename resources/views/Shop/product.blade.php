@extends('layouts.main')

@section('title', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{ route('shop-detail',['code' => $shop->code])}}">&lt; Back</a></li>
    </ul>
</nav>

<form class="form" action="{{ route('shop-list')}}" method="get">
    

    <table>
        <tr>
            <td> <label for="term">Search</label></td>
            <td class="blue">::</td>
            <td><input type="text" name="term" id="term" value="{{$data['term']}}"></td>
            <td class="actions"><button class="blue-box" type="submit">Search</button> <a  href="{{ route('product-list')}}"><button class="green-box">Clear</button></a></td>
        </tr>
        <tr>
            <td> <label for="minPrice">Min Price</label></td>
            <td class="blue">::</td>
            <td><input type="text" name="minPrice" id="minPrice" value="{{$data['minPrice']}}"></td>
        </tr>
        <tr>
            <td> <label for="maxPrice">Max Price</label></td>
            <td class="blue">::</td>
            <td><input type="text" name="maxPrice" id="maxPrice" value="{{$data['maxPrice']}}"></td>
        </tr>
</table>
</form>

<a class="link"  href="{{route('shop-add-product-form',['code' => $shop->code])}}">Add Product</a>

<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>&nbsp;</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td class="code"><a href="{{ route('product-detail',['code'=> $product->code]) }}">{{$product->code}}</a></td>
        <td>{{$product->name}}</td>
        <td>{{$product->category->name}}</td>
        <td>{{number_format((double)$product->price, 2) }}</td>
        <td><a href="{{ route('shop-remove-product', ['product' => $product->code,'shop' => $shop->code])}}">Remove</a></td>
    </tr>
    @endforeach
</table>

{{ $products->links() }}

@endsection