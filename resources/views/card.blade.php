


<div class="col">
  <div class="card h-100">
    <div class="position-absolute top-0 start-0 p-2 d-flex flex-column align-items-start">
      @if($product->isNew())
        <span class="badge bg-success mb-1">{{ __('Jaunums')}}</span>
      @endif
    
      @if($product->isRecommend())
        <span class="badge bg-warning text-dark mb-1">{{ __('Rekomendēts')}}</span>
      @endif
    
      @if($product->isHit())
        <span class="badge bg-danger">{{ __('Populārs')}}</span>
      @endif
    </div>
    
    
    <img 
      src="{{ Storage::url($product->image) }}" 
      class="card-img-top" 
      alt="{{ $product->name }}"
      style="object-fit: cover; height: 200px;"
    >
    <div class="card-body text-center">
      <h5 class="card-title">{{ __($product->name) }}</h5>
      <p class="card-text">
    {{ __('Price: :price EUR', ['price' => localized_price($product->price)]) }}
</p>

      <form action="{{ route('basket-add', ['id' => $product->id]) }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="available_count" value="{{ $product->count }}">
        @if($product->isAvailable())
            <button type="submit" class="btn btn-outline-success btn-sm me-1">{{ __('Grozā')}}</button>
        @else {{ __('Nav pieejams')}}
        @endif
      </form>
      <a 
        href="{{ route('product', ['category' => $product->category->code, 'product' => $product->code]) }}"
          class="btn btn-outline-primary btn-sm"
      >
        {{ __('Apskatīt')}}
      </a>
    </div>
  </div>
</div>
    