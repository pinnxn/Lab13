@extends('layouts.main')

@section('title','Category : View')

@section('content')

<nav>
    <a href="{{ route('category-product',['code' => $category->code])}}">Show Product</a>
    @can('update', \App\Models\Category::class)
    <a href="{{ route('category-update-form',['code' => $category->code])}}">Update</a>
    @endcan
    @can('delete', $category)
    <a href="{{ route('category-delete',['code' => $category['code']])}}">Delete</a>
    @endcan
    <a href="{{ session()->get('bookmark.category-detail',route('category-list'))}}">&lt; Back</a>
</nav>

<table>
    <tr>
        <td class="detail-label"><strong>Code</strong></td>
        <td class="blue">::</td>
        <td class="number font">{{$category->code}}</td>
    </tr>
    <tr>
        <td class="detail-label"><strong>Name</strong></td>
        <td class="blue">::</td>
        <td class="name">{{$category->name}}</td>
    </tr>
    <tr>
        <td class="detail-label"><strong>Description</strong></td>
        <td class="blue">::</td>
        <td class="description">{{$category->description}}</td>
    </tr>
</table>

@endsection