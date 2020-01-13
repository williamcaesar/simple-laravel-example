<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications\EntityCreation;
use App\Notifications\EntityDeletion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CategoryController extends Controller
{
    private $admins;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */

    public function __construct()
    {
        $this->admins = User::where('is_admin', true)->get();
    }

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::all();
        return view('Category/categoryIndex', ['categories' => $categories]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);

        return view('Category/categoryCreate');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $category = new Category([
            'name' => $request->name ? $request->name : '-',
        ]);
        $category->save();

        $user = Auth::user();
        Notification::send($this->admins,
            new EntityCreation($user->name, Category::class));

        return view('index');
    }

    public function show($id)
    {
        $this->authorize('viewAny', Category::class);
        $category = Category::find($id);
        return view('Category/categoryShow', ['category' => $category]);
    }

    public function edit($id)
    {
        $this->authorize('update', Category::class);

        $category = Category::find($id);
        return view('Category/categoryShow', ['category' => $category]);
    }

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

            $user = Auth::user();
            Notification::send($this->admins,
                new EntityDeletion($user->name, Category::class));

            return view('index');

        } catch (Exception $e) {
            return view('error');
        }
    }
}
