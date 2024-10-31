<!-- resources/views/cart/index.blade.php -->
@extends('layouts.layout')

@section('title', 'Panier')

@section('content')
    <h1>Votre panier</h1>
    
    @if(session('success'))
        <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <p>Votre panier est vide.</p>
    @else
        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity'] @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px;">
                            <p>{{ $item['name'] }}</p>
                        </td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                <button type="submit">Mettre à jour</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'], 2) }} €</td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 2) }} €</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" style="color: red;">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right;">Total</td>
                    <td>{{ number_format($total, 2) }} €</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!-- Bouton Payer -->
        <div style="text-align: right; margin-top: 20px;">
            <a href="{{ route('checkout.form') }}" style="padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">Payer</a>
        </div>
    @endif

    <a href="{{ route('products.index') }}" style="display: inline-block; padding: 10px 20px; background-color: #555; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 20px;">Retour à la boutique</a>
@endsection
