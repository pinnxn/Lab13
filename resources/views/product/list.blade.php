@extends('layouts.main')

@section('title','Product : List')

@section('content')

<form class="form" action="{{ route('product-list')}}" method="get">

    <table>
        <tr>
            <td> <label for="term"><strong>Search</strong></label></td>
            <td class="blue"><strong>::</strong></td>
            <td><input type="text" name="term" id="term" value="{{$data['term']}}"></td>
            <td class="actions"><button class="blue-box" type="submit">Search</button> <a href="{{ route('product-list')}}"><button class="green-box">Clear</button></a></td>
        </tr>
        <tr>
            <td> <label for="minPrice"><strong>Min Price</strong></label></td>
            <td class="blue"><strong>::</strong></td>
            <td><input type="text" name="minPrice" id="minPrice" value="{{$data['minPrice']}}"></td>
        </tr>
        <tr>
            <td> <label for="maxPrice"><strong>Max Price</strong></label></td>
            <td class="blue"><strong>::</strong></td>
            <td><input type="text" name="maxPrice" id="maxPrice" value="{{$data['maxPrice']}}"></td>
        </tr>
    </table>
</form>

<nav>
    <ul>
        @can('create', \App\Models\Product::class)
        <li>
            <a class="link" href="{{ route('product-create-form')}}">New Product</a>
        </li>
        @endcan
    </ul>
</nav>


<table class="list">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>No. of Shops</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td class="code"><a href="{{ route('product-detail',['code'=> $product->code]) }}">{{$product->code}}</a></td>
        <td>{{$product->name}}</td>
        <td>{{$product->category->name}}</td>
        <td>{{number_format((double)$product->price, 2) }}</td>
        <td>{{$product->shops_count}}</td>
    </tr>
    @endforeach
</table>

{{ $products->links() }}

@endsection