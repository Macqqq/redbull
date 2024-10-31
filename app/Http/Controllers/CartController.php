<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Affiche le contenu du panier
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Ajoute un produit au panier
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Récupère le panier actuel depuis la session
        $cart = session()->get('cart', []);

        // Vérifie si le produit existe déjà dans le panier
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // Stocke le panier mis à jour dans la session
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier avec succès !');
    }

    // Met à jour la quantité d'un produit dans le panier
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Quantité mise à jour avec succès !');
        }

        return redirect()->route('cart.index');
    }

    // Supprime un produit du panier
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier avec succès !');
    }
}
