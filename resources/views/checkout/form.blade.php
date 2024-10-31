<!-- resources/views/checkout/form.blade.php -->
@extends('layouts.layout')

@section('title', 'Commande')

@section('content')
    <h1>Finaliser la commande</h1>

    <form action="{{ route('checkout.confirm') }}" method="POST" style="max-width: 600px; margin: 0 auto;">
        @csrf

        <!-- Section Contact -->
        <h2>Contact</h2>
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
        <div style="margin-bottom: 15px;">
            <input type="checkbox" id="newsletter" name="newsletter">
            <label for="newsletter">Envoyez-moi des nouvelles et des offres par e-mail</label>
        </div>

        <!-- Section Livraison -->
        <h2>Livraison</h2>
        <label for="country">Pays/région :</label>
        <select id="country" name="country" style="width: 100%; padding: 10px; margin-bottom: 15px;">
            <option value="France">France</option>
            <!-- Vous pouvez ajouter d'autres pays ici -->
        </select>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="first_name">Prénom :</label>
                <input type="text" id="first_name" name="first_name" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
            </div>
            <div style="flex: 1;">
                <label for="last_name">Nom :</label>
                <input type="text" id="last_name" name="last_name" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
            </div>
        </div>

        <label for="company">Entreprise (optionnel) :</label>
        <input type="text" id="company" name="company" style="width: 100%; padding: 10px; margin-bottom: 15px;">

        <label for="address">Adresse :</label>
        <input type="text" id="address" name="address" required style="width: 100%; padding: 10px; margin-bottom: 15px;">

        <label for="address_2">Appartement, suite, etc. (optionnel) :</label>
        <input type="text" id="address_2" name="address_2" style="width: 100%; padding: 10px; margin-bottom: 15px;">

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="postal_code">Code postal :</label>
                <input type="text" id="postal_code" name="postal_code" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
            </div>
            <div style="flex: 1;">
                <label for="city">Ville :</label>
                <input type="text" id="city" name="city" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
            </div>
        </div>

        <label for="phone">Téléphone :</label>
        <input type="tel" id="phone" name="phone" style="width: 100%; padding: 10px; margin-bottom: 15px;">

        <div style="margin-bottom: 15px;">
            <input type="checkbox" id="sms_offers" name="sms_offers">
            <label for="sms_offers">Envoyez-moi des nouvelles et des offres par SMS</label>
        </div>

        <!-- Récapitulatif de la commande -->
        <h2>Récapitulatif de la commande</h2>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Produit</th>
                    <th style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Quantité</th>
                    <th style="text-align: right; padding: 8px; border-bottom: 1px solid #ddd;">Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item['name'] }}</td>
                        <td style="padding: 8px; text-align: right; border-bottom: 1px solid #ddd;">{{ $item['quantity'] }}</td>
                        <td style="padding: 8px; text-align: right; border-bottom: 1px solid #ddd;">{{ number_format($item['price'] * $item['quantity'], 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right; padding: 8px; border-top: 1px solid #ddd;">Total</td>
                    <td style="text-align: right; padding: 8px; border-top: 1px solid #ddd;">{{ number_format($total, 2) }} €</td>
                </tr>
            </tfoot>
        </table>

        <!-- Moyen de paiement sélectionné -->
        <input type="hidden" id="payment_method" name="payment_method" value="">

        <!-- Boutons de paiement -->
        <h2>Moyens de paiement</h2>
        <button type="button" onclick="setPaymentMethod('Paypal')" style="padding: 10px 20px; background-color: #0070ba; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">Paypal</button>
        <button type="button" onclick="setPaymentMethod('Stripe')" style="padding: 10px 20px; background-color: #333; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">Stripe</button>
        <button type="button" onclick="setPaymentMethod('Crypto')" style="padding: 10px 20px; background-color: #f7931a; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Crypto</button>

        <!-- Bouton confirmer la commande -->
        <button type="submit" style="display: block; width: 100%; padding: 15px; background-color: #28a745; color: #fff; border: none; border-radius: 5px; font-size: 1.2em; margin-top: 20px;">Confirmer la commande</button>
    </form>

    <script>
        function setPaymentMethod(method) {
            document.getElementById('payment_method').value = method;
            alert("Mode de paiement sélectionné : " + method); // Optionnel : Alerte pour confirmation visuelle
        }
    </script>
@endsection
