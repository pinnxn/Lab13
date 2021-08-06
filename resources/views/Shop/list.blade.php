@extends('layouts.main')

@section('title','Shop : List')

@section('content')

<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Owner</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
        <td class="code"><a href="{{ route('shop-detail',['code'=> $shop->code]) }}">{{$shop['code']}}</a></td>
        <td>{{$shop->name}}</td>
        <td>{{$shop->owner}}</td>
    </tr>
    @endforeach
</table>

@endsection