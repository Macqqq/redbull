<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Affiche la liste des produits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all(); // Récupère tous les produits
        return view('products.index', compact('products')); // Retourne la vue avec les produits
    }

    /**
     * Affiche les détails d'un produit spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id); // Trouve le produit par ID ou échoue
        return view('products.show', compact('product')); // Retourne la vue avec les détails du produit
    }

    /**
     * Affiche le formulaire de création de produit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create'); // Retourne la vue de création de produit
    }

    /**
     * Enregistre un nouveau produit dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valide les données
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        // Crée un nouveau produit
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        // Sauvegarde l'image si elle est téléchargée
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }

        $product->save(); // Sauvegarde le produit

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès !');
    }

    /**
     * Affiche le formulaire d'édition d'un produit.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Trouve le produit par ID ou échoue
        return view('products.edit', compact('product')); // Retourne la vue d'édition
    }

    /**
     * Met à jour un produit dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Valide les données
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        // Trouve le produit existant
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        // Met à jour l'image si une nouvelle image est téléchargée
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }

        $product->save(); // Sauvegarde les modifications

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès !');
    }

    /**
     * Supprime un produit de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Trouve le produit par ID ou échoue
        $product->delete(); // Supprime le produit

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès !');
    }
}
