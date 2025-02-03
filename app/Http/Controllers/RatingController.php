<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, $recipeId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $recipe = Recipe::findOrFail($recipeId);

        // Check if user has already rated this recipe
        $existingRating = Rating::where('user_id', auth()->id())
            ->where('recipe_id', $recipeId)
            ->first();

        if ($existingRating) {
            $existingRating->update(['rating' => $request->rating]);
            return response()->json($existingRating, 200);
        }

        $rating = $recipe->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return response()->json($rating, 201);
    }
}
