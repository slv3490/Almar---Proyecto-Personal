<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function articleMeditation() : View
    {
        return view("articles.meditation");
    }
    public function articleExercise() : View
    {
        return view("articles.exercise");
    }
    public function articleHobbies() : View
    {
        return view("articles.hobbies");
    }
}
