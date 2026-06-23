<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{

    public function index()
    {
    $categories = Category::all();
    return view('categories.index', compact('categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
}
