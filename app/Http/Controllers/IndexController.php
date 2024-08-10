<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Database\Eloquent\Builder;

class IndexController extends Controller
{
    public function index()
    {
        $courses = Course::limit(9)->get();
        return view("index", [
            "inicio" => true,
            "mostrar" => true,
            "courses" => $courses
        ]);
    }

    public function cursos(Request $request)
    {
        $categories = Category::all();

        $courses = Course::with("categories")
        ->when($request->category, function ($query, $categoryIds) {
            $query->whereHas('categories', function ($query) use ($categoryIds) {
                $query->where('category_id', $categoryIds);
            });
        })
        ->when($request->search, function($query, $search) {
            $query->where("title", "LIKE", "%".$search."%");
        })
        ->paginate(10);

        return view("cursos", [
            "courses" => $courses,
            "categories" => $categories,
        ]);
    }
}
