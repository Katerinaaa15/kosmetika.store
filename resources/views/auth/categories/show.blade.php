@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Kategorija:</h1>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Lauks</th>
                <th>Vērtība</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{$category->id}}</td>
            </tr>
            <tr>
                <td>Kods</td>
                <td>{{$category->code}}</td>
            </tr>
            <tr>
                <td>Nosaukums</td>
                <td>{{$category->name}}</td>
            </tr>
            <tr>
                <td>Apraksts</td>
                <td>{{$category->description}}</td>
            </tr>
            <tr>
                <td>Attēls</td>
                <td><img src="{{ Storage::url($category->image) }}" alt="Attēls" class="img-fluid" style="max-height: 150px;"></td>
            </tr>
            <tr>
                <td>Produktu skaits</td>
                <td>{{$category->products->count()}}</td>
            </tr>
        </tbody>
    </table>
</div>




@endsection