@extends('master')

@section('title', 'Kategorija' . $category->name)

@section('content')


<div class="container mt-5">
  <h1 class="text-center mb-3 display-4">
    {{ $category->name }} 
    <span class="fw-bold text-primary">({{ $category->products->count() }})</span>
  </h1>
  <p class="text-center">
    {{ $category->description }}
  </p>
</div>


  
  <div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach($category->products as $product)
    @include('card', compact('product'))
    @endforeach
  
  </div>
</div>
@endsection

