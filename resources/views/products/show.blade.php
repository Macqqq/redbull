<!-- resources/views/products/show.blade.php -->
@extends('layouts.layout')

@section('title', $product->name)

@section('content')
    <div class="product-details" style="text-align: center; max-width: 800px; margin: 0 auto;">
        <h1>{{ $product->name }}</h1>
        
        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 80%; height: auto; margin: 20px 0;">
        
        <p style="font-size: 1.2em; color: #666;">{{ $product->description }}</p>
        
        <p style="font-size: 1.5em; color: #333; margin-top: 15px;">Prix : {{ number_format($product->price, 2) }} €</p>
        
        <div class="buy-section" style="margin-top: 20px;">
            @if($product->stock > 0)
                <p style="color: green; font-weight: bold;">En stock</p>
                <button style="padding: 10px 20px; background-color: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Ajouter au panier</button>
            @else
                <p style="color: red; font-weight: bold;">Rupture de stock</p>
            @endif
        </div>
        
        <a href="{{ route('products.index') }}" style="display: inline-block; padding: 10px 20px; background-color: #555; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 20px;">Retour à la boutique</a>
    </div>
@endsection
