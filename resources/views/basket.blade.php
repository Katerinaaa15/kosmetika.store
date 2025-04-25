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
          <!-- Nosaukums + attēls ar linku -->
          <td>
            <a href="{{route ('product', [$product->category->code, $product->code])}}">
              <img src="{{ Storage::url($product->image) }}" alt="Retinols" width="50" class="mb-2 d-block mx-auto">
              {{$product->name}}
            </a>
          </td>

          <!-- Daudzums ar + un - pogām -->
          <td>
  <div class="d-flex flex-column align-items-center">
    <form action="{{ route('basket-remove', $product) }}" method="POST" class="mb-1">
      @csrf
      <button type="submit" class="btn btn-danger btn-sm">
        &minus;
      </button>
    </form>

    <span class="fw-bold">{{ $product->pivot->count }}</span>

    <form action="{{ route('basket-add', $product) }}" method="POST" class="mt-1">
      @csrf
      <button type="submit" class="btn btn-success btn-sm">
        +
      </button>
    </form>
  </div>
</td>
              
            </div>
          </td>

          <!-- Cena -->
          <td>{{$product->price}} EUR</td>

          <!-- Summa apmaksai -->
          <td>{{$product->getPriceForCount()}} EUR</td>
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

