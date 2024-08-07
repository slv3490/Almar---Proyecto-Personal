<?php

namespace App\Http\Controllers;

use session;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::all();
        return view("user.dashboard.categories.index", [
            "title" => "Categories",
            "categories" => $categories
        ]);
    }
    public function createCategories()
    {
        return view("user.dashboard.categories.create-categories", [
            "title" => "Categories"
        ]);
    }

    public function storeCategories(CategoryRequest $request) 
    {
        $category = Category::create(["name" => $request->name]);

        if($category) {
            return redirect()->route("categories.index")->with("message", "¡Categoria creada exitosamente!");
        } else {
            return abort(500);
        }
    }

}