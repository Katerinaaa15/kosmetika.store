@extends('layouts.app')
@section('title', 'Pasūtījums' . $order->id)

@section('content')


<div class="container mt-5">

    <!-- Virsraksts ar pasūtījuma numuru -->
    <h1 class="mb-4">Pasūtījums Nr. {{$order->id}}<span class="fw-bold"></span></h1>

    <!-- Klienta dati -->
    <p><strong>Pasūtītājs:</strong> <span>{{$order->name}}</span></p>
    <p><strong>Telefona numurs:</strong> <span>{{$order->phone}}</span></p>

    <!-- Tabula ar pasūtījuma saturu -->
    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Nosaukums</th>
            <th>Daudzums</th>
            <th>Cena</th>
            <th>Summa</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product )
            <tr>
                <td>
                  <!-- Attēls un nosaukums -->
                  <a href="{{ route('product', [$product->category->code, $product->code]) }}">

                     <img src="{{Storage::url($product->image)}}" width="50" class="me-2 align-middle" >
                  {{ $product->name }}
                  </a>
                </td>
                <td>
                  <!-- daudzums -->
                  1
                </td>
                <td>
                  {{ $product->price }} EUR
                </td>
                <td>
                  {{ $product->getPriceForCount() }} EUR
                </td>
              </tr>
            @endforeach
          
          <!-- Šeit vari pievienot vairāk rindu pēc vajadzības -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-end"><strong>Kopēja summa:</strong></td>
            <td class="fw-bold">
              {{ $order->getFullPrice() }} EUR
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

  </div>
  @endsection