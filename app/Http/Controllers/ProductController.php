<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications\EntityCreation;
use App\Notifications\EntityDeletion;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    private $admins;


    public function __construct()
    {
        $this->admins = User::where('is_admin', true)->get();
    }

    public function index()
    {
        $this->authorize('viewAny', Product::class);

        $all = Product::all();
        return view('Product/productIndex', [
            'products' => $all,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        $categories = Category::all();
        return view('Product/productCreate', ['categories' => $categories]);
    }

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

        $user = Auth::user();
        Notification::send($this->admins,
            new EntityCreation($user->name, Product::class));

        return view('index');
    }

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

    public function destroy($id)
    {
        $this->authorize('delete', Product::class);

        try {
            $product = Product::find($id);
            $product->delete();

            $user = Auth::user();
            Notification::send($this->admins,
                new EntityDeletion($user->name, Product::class));

            return view('index');

        } catch (Exception $e) {

            return view('error');
        }
    }
}
