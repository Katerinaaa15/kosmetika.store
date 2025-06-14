@extends('layouts.app')

@isset($category)
    @section('title', 'Rediģēt kategoriju ' . $category->name)

@else
    @section('title', 'Izveidot kategoriju')
@endisset

@section('content')


<div class="container mt-5">
    @isset($category)
    <h1 class="mb-4">Rediģēt kategoriju <b> {{$category->name}}</b></h1>
    

@else
<h1 class="mb-4">Pievienot kategoriju</h1>
    
@endisset
    
<form method="POST" 
enctype="multipart/form-data"
@isset($category)
    action="{{ route('admin.categories.update', $category) }}"
@else
    action="{{ route('admin.categories.store') }}"
@endisset
>
    <div>
        @isset($category)
        @method('PUT')
        @endisset
    @csrf

   

        <div class="mb-3 row">
            <label for="code" class="col-sm-2 col-form-label">Kods:</label>
            <div class="col-sm-10">
                @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="text" class="form-control" id="code" name="code"
                value="@isset($category){{ $category->code }} @endisset" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nosaukums:</label>
            <div class="col-sm-10">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="text" class="form-control" id="name" name="name"
                value="@isset($category){{ $category->name }} @endisset" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Apraksts:</label>
            @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <textarea class="form-control" id="description" name="description" rows="5">@isset($category){{ $category->code }} @endisset</textarea>
        </div>

        <div class="mb-4 row align-items-center">
            <label for="parent" class="col-sm-2 col-form-label">Attēls:</label>
            <div class="col-sm-10">
                <label class="btn btn-default btn-file">
                Pievienot<input type="file" style="display:none;" name="image" id="image">
            </label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Saglabāt</button>
    </form>
</div>
@endsection