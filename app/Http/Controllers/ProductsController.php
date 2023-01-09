<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


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
            'data' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'tags' => ['required'],
            'price' => ['required|numeric'],
            'user_id' => ['max:255'],
            'image' => ['required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
        ]);

        $product = new Product();
        
        $product['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $name);
            $product->image = $name;
        }
        
        $product['name'] = $request->input('name');
        $product['description'] = $request->input('description');
        $product['tags'] = $request->input('tags');
        $product['price'] = $request->input('price');

        $product->save();

        return redirect()->back()
            ->with('message', 'Product Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Product::find($request->input('id'))->update($request->all());
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
