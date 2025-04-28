@extends('layouts.app')

@section('content')



<div class="container mt-5">
  <h1 class="text-center mb-4">Pasūtījumi</h1>

  <table class="table table-striped table-hover bg-white border">
    <thead>
       
      <tr>
        <th>Nr.</th>
        <th>Vārds</th>
        <th>Telefons</th>
        <th>Pasūtīšanas datums</th>
        <th>Summa</th>
        <th>Darbības</th>
      </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
      <tr>
        <td>{{$order->id}}</td>
        <td>{{$order->name}}</td>
        <td>{{$order->phone}}</td>
        <td>{{$order->created_at->format('H:i d/m/Y')}}</td>
        <td>{{$order->getFullPrice()}} EUR</td>
        <td><a class="btn btn-success"
        
         href="{{ route('person.orders.show', $order) }}" 
         
         >Atvērt</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $orders->links() }}
</div>


@endsection