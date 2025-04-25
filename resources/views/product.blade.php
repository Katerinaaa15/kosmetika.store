{{-- resources/views/product.blade.php --}}
@extends('master')

@section('title', $product->name)

@section('content')
<div class="container my-5">
  <div class="row">
    <div class="col-md-6">
      <img 
        src="{{ Storage::url($product->image) }}" 
        class="img-fluid rounded" 
        alt="{{ $product->name }}"
      >
    </div>
    <div class="col-md-6">
      <h1>{{ $product->name }}</h1>
      <h4 class="text-success">{{ number_format($product->price,2) }} EUR</h4>
      <p class="mt-4">{{ $product->description }}</p>

      <form action="{{ route('basket-add', $product) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-success btn-lg">Pievienot grozam</button>
      </form>
    </div>
  </div>
</div>
@endsection
