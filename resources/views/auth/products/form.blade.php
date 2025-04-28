@extends('layouts.app')

@isset($product)
    @section('title', 'Rediģēt produktu ' . $product->name)
@else
    @section('title', 'Pievienot produktu')
@endisset

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">@isset($product) Rediģēt produktu <b>{{ $product->name }}</b> @else Pievienot produktu @endisset</h1>
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" enctype="multipart/form-data"
       @isset($product)
         action="{{ route('products.update', $product) }}"
       @else
         action="{{ route('products.store') }}"
       @endisset>
        @csrf
        @isset($product)
            @method('PUT')
        @endisset

        <div class="mb-3 row">
            <label for="code" class="col-sm-2 col-form-label">Kods:</label>
            <div class="col-sm-10">
                @include('layouts.error', ['fieldName'=> 'code'])
                <input type="text" name="code" class="form-control" value="{{ old('code', $product->code ?? '') }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nosaukums:</label>
            <div class="col-sm-10">
                @include('layouts.error', ['fieldName'=> 'name'])
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Cena:</label>
            <div class="col-sm-10">
                @include('layouts.error', ['fieldName'=> 'price'])
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
            </div>
        </div>


        <div class="mb-3 row">
          <label for="count" class="col-sm-2 col-form-label">Daudzums:</label>
          <div class="col-sm-10">
              @include('layouts.error', ['fieldName'=> 'count'])
              <input type="number" step="0.01" name="count" class="form-control" value="{{ old('count', $product->count ?? '') }}" required>
          </div>
      </div>

        <div class="mb-3">
            <label for="description" class="form-label">Apraksts:</label>
            @include('layouts.error', ['fieldName'=> 'description'])
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="mb-4 row align-items-center">
            <label for="parent" class="col-sm-2 col-form-label">Attēls:</label>
            <div class="col-sm-10">
                <label class="btn btn-default btn-file">
                Pievienot<input type="file" style="display:none;" name="image" id="image">
            </label>
            </div>
        </div>

        <div class="mb-4 row">
            <label for="category_id" class="col-sm-2 col-form-label">Kategorija:</label>
            <div class="col-sm-10">
                @include('layouts.error', ['fieldName'=> 'category_id'])
                <select name="category_id" class="form-select">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            @isset($product)
                                {{ $product->category_id == $category->id ? 'selected' : '' }}
                            @endisset>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @foreach (['hit'=>'Hits','new'=>'Jauns','recommend'=>'Rekomendēts'] as $field => $label)
  <div class="mb-3 row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10 form-check">
      <input 
        class="form-check-input" 
        type="checkbox" 
        name="{{ $field }}" 
        id="{{ $field }}" 
        value="1"
        {{ old($field, $product->$field ?? false) ? 'checked' : '' }}
      >
      <label class="form-check-label" for="{{ $field }}">
        {{ $label }}
      </label>
    </div>
  </div>
@endforeach

        <button type="submit" class="btn btn-success">Saglabāt</button>
    </form>
</div>
@endsection
