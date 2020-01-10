<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $all = Product::all();
        return view('Product/productIndex', [
            'products' => $all,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        Gate::authorize('is_admin', $user);

        $categories = Category::all();
        return view('Product/productCreate', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        Gate::authorize('is_admin', $user);

        $product = new Product([
            'name' => $request->name ? $request->name : '-',
            'value' => $request->value ? $request->value : 0,
            'quantity' => $request->quantity ? $request->quantity : 0,
            'category_id' => $request->category_id
        ]);
        $product->save();
        return view('index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        $categoryName = $product->category->name;

        return view('Product/productShow', [
            'product' => $product,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        Gate::authorize('is_admin', $user);

        $product = Product::find($id);
        $categories = Category::all();

        return view('Product/productShow', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        Gate::authorize('is_admin', $user);

        try {
            $product = Product::find($id);
            $product->name = $request->name ? $request->name : '-';
            $product->value = $request->value ? $request->value : 0;
            $product->quantity = $request->quantity ? $request->quantity : 0;

            $product->save();
            return view('index');

        } catch (Exception $e) {
            return view('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('delete');

        try {
            $product = Product::find($id);
            $product->delete();
            return view('index');

        } catch (Exception $e) {

            return view('error');
        }
    }
}
