@extends('master')

@section('title', 'Grozs')

@section('content')

<!-- Kategoriju saturs -->
<h1 class="text-center mb-3">Grozs</h1>
  <h4 class="text-center mb-4">Pasūtījumu noformēšana</h4>

  <div class="table-responsive">
    <table class="table align-middle text-center">
      <thead class="table-light">
        <tr>
          <th>Nosaukums</th>
          <th>Daudzums</th>
          <th>Cena</th>
          <th>Summa apmaksai</th>
        </tr>
      </thead>
      <tbody>
      @if ($order && $order->products->count())
      @foreach($order->products as $product)
      <tr>
          <td>
              <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                  <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" width="50">
                  {{ $product->name }}
              </a>
          </td>

          <!-- Daudzums ar + un - pogām -->
          <td>
              <div class="d-flex flex-column align-items-center">
                <form action="{{ route('basket-remove', ['id' => $product->id]) }}" method="POST" class="mb-1">
                  @csrf
                  <button type="submit" class="btn btn-danger btn-sm">−</button>
              </form>
              
                  <span class="fw-bold">{{ $product->pivot->count }}</span>
                  <form action="{{ route('basket-add', ['id' => $product->id]) }}" method="POST" class="mt-1">
                    @csrf
                    <input type="hidden" name="available_count" value="{{ $product->count }}">
                    <button type="submit" class="btn btn-success btn-sm"
                        @if($product->pivot->count >= $product->count) disabled @endif>
                        +
                    </button>
                </form>
                
                  <small class="text-muted">
                      Pieejams: {{ $product->count }} 
                      @if($product->pivot->count >= $product->count)
                          <span class="text-danger">Nav pieejams vairāk</span>
                      @endif
                  </small>
              </div>
          </td>
          <td>{{ $product->price }} EUR</td>
          <td>{{ $product->getPriceForCount() }} EUR</td>
      </tr>
      @endforeach      
        @else
  <tr>
    <td colspan="4">Grozs ir tukšs.</td>
  </tr>
@endif
        
      </tbody>
    </table>
  </div>

  <!-- Kopējā summa -->
  <div class="d-flex justify-content-between align-items-center mt-4">
    <h5>Kopējā summa:</h5>
    <h4 class="text-success">
  {{ $order ? $order->getFullPrice() . ' EUR' : '0 EUR' }}
</h4>

  </div>

  <!-- Poga -->
  <div class="btn-group pull-right" role="group">
    <a type="button" class="btn btn-success" href="{{route('basket-place')}}">Noformēt pirkumu</a>
  </div>

</div>
@endsection

