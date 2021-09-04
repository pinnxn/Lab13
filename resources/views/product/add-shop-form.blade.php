@extends('layouts.main')

@section('title', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{ route('product-shop',['code' => $product->code])}}">&lt; Back</a></li>
    </ul>
</nav>


<form class="form" action="{{route('product-add-shop', ['product' => $product->code])}}" method="get">

    <table>
        <tr>
            <td><label for="term">Search</label></td>
            <td class="blue">::</td>
            <td class="input-search"> <input type="text" name="term" id="term" value="{{$data['term']}}"></td>
            <td class="actions"><button class="blue-box" type="submit">Search</button> <a  href="{{ route('product-list')}}"><button class="green-box">Clear</button></a></td>
        </tr>
    </table>

</form>


<form class="link"  action="{{route('product-add-shop', ['product' => $product->code])}}" method="post" >
    @csrf
<br>

<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Owner</th>
        <th>&nbsp;</th>

    </tr>
    @foreach($shops as $shop)
    <tr>
        <td class="code"><a href="{{ route('shop-detail',['code'=> $shop->code]) }}">{{$shop->code}}</a></td>
        <td>{{$shop->name}}</td>
        <td>{{$shop->owner}}</td>
        <td><button type="submit" name="shop" value="{{ $shop->code }}"> Add </button></td> 
    </tr>
    @endforeach
</table>

</form>

{{$shops->links()}}

@endsection