<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;



class CheckoutController extends Controller
{
    public function form()
    {
        // Récupère le contenu du panier
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Retourne la vue du formulaire de commande avec le panier et le total
        return view('checkout.form', compact('cart', 'total'));
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'address_2' => 'nullable|string|max:500',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'payment_method' => 'required|string|max:255',
        ]);

        // Récupérer le contenu du panier
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Créer la commande dans la base de données
        $order = Order::create([
            'email' => $validated['email'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'company' => $validated['company'],
            'address' => $validated['address'],
            'address_2' => $validated['address_2'],
            'postal_code' => $validated['postal_code'],
            'city' => $validated['city'],
            'country' => 'France',
            'phone' => $validated['phone'],
            'payment_status' => 'En attente de paiement',
            'payment_method' => $validated['payment_method'],
            'total' => $total,
        ]);

        // Enregistrer chaque produit dans la table `order_items`
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Vider le panier après la commande
        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Votre commande a été passée avec succès et est en attente de paiement.');
    }
}
