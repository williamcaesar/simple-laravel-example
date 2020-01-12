<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        $all = Product::all();
        return view('Product/productIndex', [
            'products' => $all,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        $categories = Category::all();
        return view('Product/productCreate', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

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
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('viewAny', Product::class);

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
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update', Product::class);

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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Product::class);

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
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Product::class);

        try {
            $product = Product::find($id);
            $product->delete();
            return view('index');

        } catch (Exception $e) {

            return view('error');
        }
    }
}
