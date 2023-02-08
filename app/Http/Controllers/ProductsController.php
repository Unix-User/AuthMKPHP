<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Products', [
            'data' => Product::all()->where('team_id',  '=', auth()->user()->current_team_id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'tags' => ['required'],
            'price' => ['required|numeric'],
            'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
        ]);
        $image = $request->file('image');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = Storage::disk('images')->putFileAs('products', $image, $fileName);
        $product = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'team_id' => auth()->user()->current_team_id,
            'tags' => $request->tags,
            'image' => $imagePath
        ];
        Product::create($product);

        return redirect()->back()
            ->with('message', 'Product Created Successfully for team ');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'id' => ['required', 'exists:products,id,team_id,' . auth()->user()->current_team_id],
            'name' => ['required'],
            'description' => ['required'],
            'tags' => ['required'],
            'price' => ['required|numeric'],
            'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
        ]);
        $image = $request->file('image');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = Storage::disk('images')->putFileAs('products', $image, $fileName);
        $product = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'team_id' => auth()->user()->current_team_id,
            'tags' => $request->tags,
            'image' => $imagePath
        ];
        if ($request->has('id')) {
            Product::find($request->input('id'))->update($product);
            return redirect()->back()
                ->with('message', 'Product Updated Successfully.');
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Product::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
