@extends('layouts.main')

@section('title', $title)

@section('content')


<form class="form" action="{{ route('shop-list')}}" method="get">

    <table>
        <tr>
            <td><label for="term">Search</label></td>
            <td class="blue">::</td>
            <td class="input-search"> <input type="text" name="term" id="term" value="{{$data['term']}}"></td>
            <td class="actions"><button class="blue-box" type="submit">Search</button> <a  href="{{ route('product-list')}}"><button class="green-box">Clear</button></a></td>
        </tr>
    </table>

</form>

<br>
@can('update', \App\Models\Product::class)
<a class="link"  href="{{ route('product-add-shop-form', ['product' => $product->code])}}">Add Shop</a>
@endcan


<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Owner</th>
        @can('update', \App\Models\Product::class)
        <th>&nbsp;</th>
        @endcan
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td class="code"><a href="{{ route('shop-detail',['code'=> $shop->code]) }}">{{$shop->code}}</a></td>
        <td>{{$shop->name}}</td>
        <td>{{$shop->owner}}</td>
        @can('update', \App\Models\Product::class)
        <td><a href="{{ route('product-remove-shop', ['product' => $product->code,'shop' => $shop->code])}}">Remove</a></td>
        @endcan
    </tr>
    @endforeach
</table>
<br>
<nav>
    <ul>
        <li><a href="{{ route('product-detail',['code' => $product->code])}}">&lt; Back</a></li>
    </ul>
</nav>

{{$shops->links()}}

@endsection