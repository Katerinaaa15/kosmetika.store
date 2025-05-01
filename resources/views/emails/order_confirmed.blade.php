@extends('layouts.app')

@section('content')

<h1>Paldies par Jūsu pasūtījumu, {{ $order->name }}!</h1>
<p>Pasūtījuma numurs: {{ $order->id }}</p>
<p>Kopējā summa: {{ $order->getFullPrice() }} EUR</p>
<p>Mēs sazināsimies ar Jums tuvākajā laikā.</p>

@endsection
