@extends('layouts.main')

@section('title', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{ route('category-detail',['code' => $category->code])}}">&lt; Back</a></li>
    </ul>
</nav>

<form class="form" action="{{ route('category-list')}}" method="grt">
    

    <table>
        <tr>
            <td> <label for="term">Search</label></td>
            <td class="blue">::</td>
            <td><input type="text" name="term" id="term" value="{{$data['term']}}"></td>
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
        <td>{{number_format((double)$product->price, 2) }}</td>
    </tr>
    @endforeach
</table>

{{ $products->links() }}

@endsection