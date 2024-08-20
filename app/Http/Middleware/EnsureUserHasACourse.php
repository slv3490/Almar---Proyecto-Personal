<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasACourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $courseUrl = $request->route()->parameter("courseUrl");
        $courseToComparate = Course::where("url", $courseUrl)->first();
        $courses = $user->purchasedCourses;
        if($courseToComparate) {
            foreach ($courses as $course) {
                if($course->url === $courseToComparate->url) {
                    return $next($request);
                }
            }
        }
        return redirect()->route("cursos")->with("error", "El curso no existe");
    }
}
