<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCategoryController extends Controller
{
    public function categoriesQuery()
    {
        $categories = Category::all();
        return response()->json([
            $categories
        ], 200);
    }

    public function categoryUpdate(Request $request) 
    {
        $categoryId = Category::find($request->id);
        $categoryId->name = $request->name;
        $categoryId->save();

        return response()->json([
            $categoryId
        ]);
    }

    public function categoryRemove(Request $request) 
    {
        $categoryId = Category::find($request->id);
        $categoryId->delete();

        return response()->json([
            $categoryId
        ]);

    }
}