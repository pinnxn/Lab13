@extends('layouts.main')

@section('title','Shop : List')

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


@can('update', \App\Models\Shop::class)
<a class="link" href="{{ route('shop-create-form')}}">New Shop</a>
@endcan

<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Owner</th>
        <th>No. of Products</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td class="code"><a href="{{ route('shop-detail',['code'=> $shop->code]) }}">{{$shop->code}}</a></td>
        <td>{{$shop->name}}</td>
        <td>{{$shop->owner}}</td>
        <td>{{$shop->products_count}}</td>
    </tr>
    @endforeach
</table>

{{$shops->links()}}

@endsection