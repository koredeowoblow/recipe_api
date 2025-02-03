<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggleFavorite($recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $favorite = Favorite::where('user_id', auth()->id())
                            ->where('recipe_id', $recipeId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Recipe removed from favorites']);
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'recipe_id' => $recipeId,
        ]);

        return response()->json(['message' => 'Recipe added to favorites']);
    }

    public function getFavorites()
    {
        return response()->json(auth()->user()->favorites()->with('recipe')->get());
    }
}
