@extends('layouts.main')

@section('title','Category : List')

@section('content')

<form class="form" action="{{ route('category-list')}}" method="grt">

    <table>
        <tr>
            <td><label for="term"><strong>Search</strong></label></td>
            <td class="blue"><strong>::</strong></td>
            <td class="input-search"> <input type="text" name="term" id="term" value="{{$data['term']}}"></td>
            <td class="actions"><button class="blue-box" type="submit">Search</button> <a  href="{{ route('product-list')}}"><button class="green-box">Clear</button></a></td>
        </tr>
    </table>

</form>

<div >
    

  
    </div>

<a class="link" href="{{ route('category-create-form')}}">New Category</a>


<table class="list"> 
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>No. of Products</th>
    </tr>
    @foreach($categories as $category)
    <tr>
        <td class="code"><a href="{{ route('category-detail',['code'=> $category->code]) }}">{{$category->code}}</a></td>
        <td>{{$category->name}}</td>
        <td>{{$category->products_count}}</td>
    </tr>
    @endforeach
</table>

{{$categories->links()}}

@endsection