<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Categories::create($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function update(Request $request, Categories $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category->update($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return response()->json(['success' => true]);
    }
}