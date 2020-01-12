<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::all();
        return view('Category/categoryIndex', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        Mail::to('fakeemail@email.com')->send(new App\Mail\CategoryCreated());

        return view('Category/categoryCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

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
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('viewAny', Category::class);
        $category = Category::find($id);
        return view('Category/categoryShow', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update', Category::class);

        $category = Category::find($id);
        return view('Category/categoryShow', ['category' => $category]);
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
        $this->authorize('update', Category::class);

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
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Category::class);

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
