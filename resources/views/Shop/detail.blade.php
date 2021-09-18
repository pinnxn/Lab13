@extends('layouts.main')

@section('title','Shop : View')

@section('content')

<nav>
    <a href="{{ route('shop-product',['code' => $shop->code])}}">Show Product</a>
    @can('update', \App\Models\Shop::class)
    <a href="{{ route('shop-update-form',['code' => $shop->code])}}">Update</a>
    @endcan
    @can('update', \App\Models\Shop::class)
    <a href="{{ route('shop-delete',['code' => $shop['code']])}}">Delete</a>
    @endcan
    <a href="{{ session()->get('bookmark.shop-detail',route('shop-list'))}}">&lt; Back</a>
</nav>

<table>
    <tr>
        <td class="detail-label"><strong>Code</strong></td>
        <td class="blue">::</td>
        <td class="number font">{{$shop->code}}</td>
    </tr>
    <tr>
        <td class="detail-label"><strong>Name</strong></td>
        <td class="blue">::</td>
        <td class="name">{{$shop->name}}</td>
    </tr>
    <tr>
        <td class="detail-label"><strong>Owner</strong></td>
        <td class="blue">::</td>
        <td>{{$shop->owner}}</td>
    </tr>
    <tr>
        <td class="detail-label"><strong>Location</strong></td>
        <td class="blue">::</td>
        <td class="number">{{$shop->latitude}} , {{$shop->longitude}}</td>
    </tr>
    <tr>
        <td class="detail-label"><strong>Address</strong></td>
        <td class="blue">::</td>
        <td class="address">{{$shop->address}}</td>
    </tr>
</table>

@endsection