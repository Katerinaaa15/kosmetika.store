@extends('master')

@section('title', 'Visas kategorijas')

@section('content')


<div class="container my-5">
  <h2 class="text-center mb-4">Produktu kategorijas</h2>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
    @foreach($categories as $category)
      <div class="col text-center">
        <img src="{{ Storage::url($category->image) }}"
             alt="{{ $category->name }}"
             class="mb-2"
             width="120"
             height="100">

        
        <a href="{{ route('category', $category->code) }}"
           class="text-decoration-none">
          <h5 class="fw-normal text-dark">
            {{ $category->name }}
          </h5>
        </a>

        <p>{{ $category->description }}</p>
      </div>
    @endforeach
  </div>
</div>
@endsection
