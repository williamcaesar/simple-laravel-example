<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index()
    {
        $all = Category::all();
        return view('Category/categoryIndex', ['categories' => $all]);
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

        return view('Category/categoryCreate');
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

        $category = new Category([
            'name' => $request->name ? $request->name : '-',
        ]);
        $category->save();
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
        $category = Category::find($id);
        return view('Category/categoryShow', ['category' => $category]);
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

        $category = Category::find($id);
        return view('Category/categoryShow', ['category' => $category]);
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
            $category = Category::find($id);
            $category->name = $request->name ? $request->name : '-';
            $category->save();
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
        $user = Auth::user();
        Gate::authorize('is_admin', $user);

        try {
            $category = Category::find($id);

            $products = $category->products;
            foreach ($products as $product) {
                $product->delete();
            }

            $category->delete();
            return view('index');

        } catch (Exception $e) {
            return view('error');
        }
    }
}
