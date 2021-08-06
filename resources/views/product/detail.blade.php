@extends('layouts.main')

@section('title','Product : View')

@section('content')

<table>
    <tr>
        <td><strong>Code</strong></td>
        <td class="blue">::</td>
        <td>{{$product->code}}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td class="blue">::</td>
        <td class="name">{{$product->name}}</td>
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