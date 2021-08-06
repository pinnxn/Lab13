@extends('layouts.main')

@section('title','Shop : View')

@section('content')

<table>
    <tr>
        <td class="detail-label"><strong>Code</strong></td>
        <td class="blue">::</td>
        <td class="number">{{$shop->code}}</td>
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