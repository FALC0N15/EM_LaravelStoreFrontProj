@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>

    {{-- your categories grid goes here --}}
    @foreach($categories as $category)
        <div>{{ $category->category_name }}</div>
    @endforeach
<a href="/" class="btn btn-primary">Back to Home</a>
@endsection
