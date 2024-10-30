<!-- resources/views/products/index.blade.php -->
@extends('layouts.layout')

@section('title', 'Liste des Produits')

@section('content')
    <h1>Nos produits</h1>
    @if($products->isEmpty())
        <p>Aucun produit disponible pour le moment.</p>
    @else
        <div class="products">
            @foreach($products as $product)
                <div class="product">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->price }} €</p>
                    <a href="{{ route('products.show', $product->id) }}" class="btn">Voir le produit</a>
                </div>
            @endforeach
        </div>
    @endif
@endsection
