<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
    
        $category = Category::create($validatedData);
    
        return response()->json($category, 201);
    }
    
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
    
        $category->update($validatedData);
    
        return response()->json($category);
    }

}
