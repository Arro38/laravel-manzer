<?php
// app/Http/Controllers/MealController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    // Afficher tous les repas
    public function index()
    {
        $meals = Meal::with('user')->get();
        return response($meals);
    }

    // Créer un repas
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ajoutez l'ID de l'utilisateur connecté comme créateur du repas
        $meal = Auth::user()->meals()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image') ? $request->file('image')->store('images/meals', 'public') : null,
        ]);

        return response( $meal);
    }

    // Modifier un repas
    public function update(Meal $meal,Request $request )
    {
        $userId = $meal->user->id;
        // Vérifiez si l'utilisateur connecté est le propriétaire du repas
        if ( $request->user()->id !== $userId) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $meal->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->file('image') ? $request->file('image')->store('images/meals', 'public') : $meal->image,
        ]);

        return response($meal);
    }

    // Supprimer un repas
    public function destroy(Request $request,Meal $meal)
    {
        $userId = $meal->user->id;
        // Vérifiez si l'utilisateur connecté est le propriétaire du repas
        if ($request->user()->id !== $userId) {
            return response(['message' => 'Unauthorized'], 403);
        }

        $meal->delete();

        return response(['message' => 'Meal deleted successfully']);
    }

    public function show(Meal $meal)
    {
        return response($meal);
    }

    public function myMeals(Request $request)
    {
        $meals = $request->user()->meals;
        return response($meals);
    }
}
