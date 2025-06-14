@extends('master')

@section('title', 'Galvenā')

@section('content')
<form method="get" action="{{ route('index') }}"
      class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
  
  
  <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
    <div class="me-md-3 mb-2 mb-md-0">
      <label for="price_from" class="form-label mb-0">{{ __('Cena no:') }}</label>
      <input type="number" step="0.01" id="price_from" name="price_from"
             class="form-control @error('price_from') is-invalid @enderror"
             placeholder="0.00"
             value="{{ old('price_from', request('price_from')) }}">
      @error('price_from')
        <div class="invalid-feedback d-block">{{ $message }}</div>
      @enderror
    </div>
    <div>
      <label for="price_to" class="form-label mb-0">{{ __('līdz:') }}</label>
      <input type="number" step="0.01" id="price_to" name="price_to"
             class="form-control @error('price_to') is-invalid @enderror"
             placeholder="0.00"
             value="{{ old('price_to', request('price_to')) }}">
      @error('price_to')
        <div class="invalid-feedback d-block">{{ $message }}</div>
      @enderror
    </div>
  </div>

  
  <div class="d-flex flex-wrap align-items-center">
    <div class="form-check me-3">
      <input class="form-check-input" type="checkbox" id="filter_hit"
             name="hit" value="1" @checked(request()->has('hit'))>
      <label class="form-check-label" for="filter_hit">{{ __('Populārs') }}</label>
    </div>
    <div class="form-check me-3">
      <input class="form-check-input" type="checkbox" id="filter_new"
             name="new" value="1" @checked(request()->has('new'))>
      <label class="form-check-label" for="filter_new">{{ __('Jaunums') }}</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="filter_recommend"
             name="recommend" value="1" @checked(request()->has('recommend'))>
      <label class="form-check-label" for="filter_recommend">{{ __('Rekomendēts') }}</label>
    </div>
  </div>

  
  <div class="d-flex align-items-center">
    <button type="submit" class="btn btn-pink me-2">
      {{ __('Filtrēt') }}
    </button>
    <a href="{{ route('index') }}" class="btn btn-secondary">
      {{ __('Noņemt filtrus') }}
    </a>
  </div>
</form>


<div class="container mt-4">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @forelse($products as $product)
      @include('card', compact('product'))
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">
          {{ __('Nav atrasti produkti ar šiem filtriem.') }}
        </div>
      </div>
    @endforelse
  </div>
</div>


<div class="d-flex justify-content-center my-4">
  {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@endsection
