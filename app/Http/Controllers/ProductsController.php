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
        Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ])->validate();

        Product::create($request->all());

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