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

      <form action="{{ route('basket-add', ['id' => $product->id]) }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="available_count" value="{{ $product->count }}">
        @if($product->isAvailable())
            <button type="submit" class="btn btn-success btn-lg">{{ __('Pievienot grozam<')}}/button>
        @else
            <span class="text-danger">{{ __('Nav pieejams')}}</span>
        @endif
    </form>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    </div>
  </div>
</div>
@endsection
