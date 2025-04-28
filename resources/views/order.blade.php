@extends('master')

@section('title', 'Noformēt pasūtījumu')

@section('content')

<div style="max-width: 600px;">
  <h1 class="text-center mb-4">Pasūtījuma noformēšana</h1>

  <!-- Summa apmaksai -->
  <div class="mb-4 text-center">
    <h5>Summa apmaksai:</h5>
    <h4 class="text-success">{{$order->getFullPrice()}} EUR</h4>
  </div>

  <!-- Norādes teksts -->
  <p class="text-center mb-3">Uzrakstiet Jūsu Vārdu un telefona numuru</p>

  <!-- Forma -->
  <form action ="{{route('basket-confirm')}}" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label">Vārds</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Jūsu vārds">
    </div>

    <div class="mb-4">
      <label for="phone" class="form-label">Telefona numurs</label>
      <input type="tel" name="phone" class="form-control" id="phone" placeholder="Jūsu tālruņa numurs">
    </div>

    <!-- Poga -->
    <div class="text-center">
        @csrf
      <input type="submit" class="btn btn-success" value="Apstiprināt pasūtījumu">
    </div>
  </form>
</div>

@endsection

