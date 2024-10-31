<!-- resources/views/products/index.blade.php -->
@extends('layouts.layout')

@section('title', 'Liste des Produits')

@section('content')
    <h1>Nos produits</h1>
    
    @if($products->isEmpty())
        <p>Aucun produit disponible pour le moment.</p>
    @else
        <div class="products" style="display: flex; flex-wrap: wrap; gap: 20px;">
            @foreach($products as $product)
                <div class="product" style="border: 1px solid #ddd; padding: 15px; width: calc(33.333% - 20px); box-sizing: border-box; text-align: center; background-color: #fff;">
                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                    
                    <h2 style="font-size: 1.5em; margin-top: 10px;">{{ $product->name }}</h2>
                    <p style="font-size: 1.2em; color: #333;">{{ number_format($product->price, 2) }} €</p>
                    <p>{{ $product->description }}</p>
                    
                    <!-- Lien vers la page de détails du produit -->
                    <a href="{{ route('products.show', ['name' => $product->name]) }}" style="display: block; margin: 10px 0; color: #333; text-decoration: underline;">Voir le produit</a>
                    
                    <!-- Bouton Ajouter au Panier -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <button type="submit" style="padding: 10px 20px; background-color: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Ajouter au panier</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
