@extends('master')

@section('title', 'Noformēt pasūtījumu')

@section('content')

<div style="max-width: 600px;">
  <h1 class="text-center mb-4">Pasūtījuma noformēšana</h1>

  
  <div class="mb-4 text-center">
    <h5>Summa apmaksai:</h5>
    <h4 class="text-success">{{$order->getFullPrice()}} EUR</h4>
  </div>

  
  <p class="text-center mb-3">Uzrakstiet Jūsu Vārdu un telefona numuru</p>

  
  <form action ="{{route('basket-confirm')}}" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label">Vārds</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Jūsu vārds">
    </div>

    
    <div class="mb-4">
      <label for="phone" class="form-label">Telefona numurs</label>
      <input type="tel" name="phone" class="form-control" id="phone" placeholder="Jūsu tālruņa numurs">
    </div>
    @guest
    <div class="mb-4">
      <label for="phone" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Jūsu epasta adrese">
    </div>
    @endguest
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    
    <div class="text-center">
        @csrf
      <input type="submit" class="btn btn-success" value="Apstiprināt pasūtījumu">
    </div>
  </form>
</div>

@endsection

