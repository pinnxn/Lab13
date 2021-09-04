@extends('layouts.main')

@section('title', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{ route('category-product',['code' => $category->code])}}">&lt; Back</a></li>
    </ul>
</nav>

<form class="form" action="{{ route('category-add-product',['code' => $category->code])}}" method="get">
    

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


<form action="{{ route('category-add-product',['code' => $category->code])}}" method="post" >
@csrf
<br>
<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Price</th>
        <th>&nbsp;</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td class="code"><a href="{{ route('product-detail',['code'=> $product->code]) }}">{{$product->code}}</a></td>
        <td>{{$product->name}}</td>
        <td>{{number_format((double)$product->price, 2) }}</td>
        <td><button type="submit" name="product" value="{{ $product->code }}"> Add </button></td> 
    </tr>
    @endforeach
</table>

{{ $products->links() }}

@endsection
</form>