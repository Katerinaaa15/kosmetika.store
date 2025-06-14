@extends('layouts.app')

@section('content')



    <div class="container mt-5">
        <h2>Kategorijas</h2>

        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nr.</th>
                    <th scope="col">Kods</th>
                    <th scope="col">Nosaukums</th>
                    <th scope="col">Darbība</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)

            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->code}}</td>
                <td>{{$category->name}}</td>
                <td>
                    
                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-success btn-sm me-2">Atvērt</a>
            
                    
                    <form action="" method="POST" class="d-inline-block">
                        @csrf
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm me-2">Rediģēt</a>
                    </form>
            
                    
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Noņemt</button>
                    </form>
                </td>
            </tr>
            
                
            @endforeach
            
                
            </tbody>
        </table>
        {{ $categories->links() }}

        
        <a class="btn btn-success" type="button"
        href="{{ route('admin.categories.create') }}">Pievienot kategoriju</a>
    </div>






@endsection