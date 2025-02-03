<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        return Recipe::with('user')->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'ingredients' => 'required|array',
            'instructions' => 'required',
            'category' => 'required' //+
        ]);

        $recipe = Recipe::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'category' => $request->category
        ]);

        return response()->json($recipe, 201);
    }

    public function show($id)
    {
        return Recipe::with(['user', 'comments', 'ratings'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        if ($recipe->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([ //+
            'title' => 'sometimes|required', //+
            'description' => 'sometimes|required', //+
            'ingredients' => 'sometimes|required|array', //+
            'instructions' => 'sometimes|required', //+
            'category' => 'sometimes|required' //+
        ]); //+
        $recipe->update($request->all());
        return response()->json($recipe);
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        if ($recipe->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $recipe->delete();
        return response()->json(['message' => 'Recipe deleted']);
    }
}
