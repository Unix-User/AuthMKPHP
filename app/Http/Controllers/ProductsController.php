<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(): JsonResponse
    {
        $teamId = Auth::user()->current_team_id;
        return response()->json(['data' => Product::where('team_id', $teamId)->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'tags' => ['required'],
            'price' => ['required', 'numeric'],
            'rate' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ])->validate();

        $imagePath = $request->file('image')->store('products', 'images');

        $product = Auth::user()->currentTeam->products()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'rate' => $validated['rate'],
            'tags' => $validated['tags'],
            'image' => $imagePath,
        ]);

        return response()->json(['message' => 'Product Created Successfully.', 'data' => $product], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'id' => ['required', Rule::exists('products', 'id')->where(fn ($query) => $query->where('team_id', Auth::user()->current_team_id))],
            'name' => ['required'],
            'description' => ['required'],
            'tags' => ['required'],
            'price' => ['required', 'numeric'],
            'rate' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ])->validate();

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'images');
            $product->update(['image' => $imagePath]);
        }

        $product->update($validated);

        return response()->json(['message' => 'Product Updated Successfully.', 'data' => $product]);
    }

    public function destroy(int $id): JsonResponse
    {
        Product::destroy($id);
        return response()->json(['message' => 'Product Deleted Successfully.']);
    }
}
