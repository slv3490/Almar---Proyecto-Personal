<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        $courses = Auth::user()->purchasedCourses;

        return view("user.dashboard.dashboard", [
            "title" => "Dashboard",
            "courses" => $courses
        ]);
    }

    public function myCourses()
    {
        $courses = Auth::user()->purchasedCourses;

        return view("user.dashboard.my-courses", [
            "title" => "MyCourses",
            "courses" => $courses
        ]);
    }
    public function favorites()
    {
        return view("user.dashboard.favorites", [
            "title" => "Favorites"
        ]);
    }
    
}