@extends('layouts.main')

@section('title','Product : List')

@section('content')

<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td class="code"><a href="{{ route('product-detail',['code'=> $product->code]) }}">{{$product->code}}</a></td>
        <td>{{$product->name}}</td>
    </tr>
    @endforeach
</table>

@endsection