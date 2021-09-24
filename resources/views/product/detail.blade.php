@extends('layouts.main')

@section('title','Product : View')

@section('content')

<nav>
    <a href="{{ route('product-shop',['code' => $product->code])}}">Show Shop</a>

    @can('update', \App\Models\Product::class)
    <a href="{{ route('product-update-form',['code' => $product->code])}}">Update</a>
    @endcan

    @can('update', \App\Models\Product::class)
    <a href="{{ route('product-delete',['code' => $product['code']])}}">Delete</a>
    @endcan
    <a href="{{ session()->get('bookmark.product-detail',route('product-list'))}}">&lt; Back</a>
</nav>

<table>
    <tr>
        <td> <strong>Code</strong> </td>
        <td class="blue">::</td>
        <td>{{$product->code}}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td class="name">{{$product->name}}</td>
    </tr>
    <tr>
        <td><strong>Category</strong></td>
        <td class="blue">::</td>
        <td class="name"> [{{$product->category->code}}] {{$product->category->name}}</td>
    </tr>
    <tr>
        <td><strong>Price</strong></td>
        <td class="blue">::</td>
        <td class="number">{{number_format((double) $product->price , 2) }}</td>
    </tr>
</table>
<pre>
{{$product['description']}}
</pre>

@endsection