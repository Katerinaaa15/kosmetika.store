@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <h2>Produkti</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Kods</th>
                <th>Nosaukums</th>
                <th>Cena</th>
                <th>Daudzums</th>
                <th>Darbība</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }} €</td>
                <td>{{ $product->count }} </td>
                <td>
                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-success btn-sm me-2">Atvērt</a>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm me-2">Rediģēt</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Noņemt</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
    <a class="btn btn-success" href="{{ route('admin.products.create') }}">Pievienot produktu</a>
</div>
@endsection
