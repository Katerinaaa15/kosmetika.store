@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Produkts:</h1>
    <table class="table table-bordered">
        <tr><th>Lauks</th><th>Vērtība</th></tr>
        <tr><td>ID</td><td>{{ $product->id }}</td></tr>
        <tr><td>Kods</td><td>{{ $product->code }}</td></tr>
        <tr><td>Nosaukums</td><td>{{ $product->name }}</td></tr>
        <tr><td>Apraksts</td><td>{{ $product->description }}</td></tr>
        <tr><td>Attēls</td><td><img src="{{ Storage::url($product->image) }}" height="240px"></td></tr>
        <tr><td>Cena</td><td>{{ $product->price }} €</td></tr>
        <tr><td>Kategorija</td><td>{{ $product->category->name }}</td></tr>
        <tr><td>Uzlīmes</td>
            <td>
                @if($product->isNew())
            <span class="badge bg-success me-1">Jaunums</span>
          @endif
    
          @if($product->isRecommend())
            <span class="badge bg-warning text-dark me-1">Rekomendēts</span>
          @endif
    
          @if($product->isHit())
            <span class="badge bg-danger">Populārs</span>
          @endif</td></tr>
    </table>
</div>
@endsection
