<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate(['name' => 'required|unique:categories']);
        Category::create($request->all());
        return back()->with('success', 'Category added successfully');
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('category.create');
    }

    //show - to show all products in a category get the category id from the url query string id=categoty_id
    public function show(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $category = Category::find($request->id);
        //return all products in the $category
        $products = $category->products;
        return view('product-list-partial', ['products' => $products]);
    }
}
