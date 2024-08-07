<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\CategoryCourse;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class CourseController extends Controller
{
    public function index() {
        $user = Auth::user();
        $courses = Course::where("user_id", $user->id)->paginate(10);
        return view("user.dashboard.courses.index", [
            "title" => "Courses",
            "courses" => $courses
        ]);
    }

    public function createCourses() {
        return view("user.dashboard.courses.create-courses", [
            "title" => "Courses"
        ]);
    }

    public function storeCourses(CourseRequest $request) {
        // Generando nombre unico con extencion del archivo
        
        if($request->image_uri) {
            $extension = $request->image_uri->getClientOriginalExtension();
            $imageName = md5(uniqid(rand(), true)).".". $extension;
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->image_uri->getRealPath());
            $image->cover(306, 204);
            $image->save(storage_path("app/public/images/". $imageName));
            $url = md5(uniqid(rand(), true));
        }
        //Url de la leccion que pertenece a un usuario en especifico

        $course = Course::create([
            "title" => $request->title,
            "description" => $request->description,
            "image_uri" => $imageName,
            "url" => $url,
            "price" => $request->price,
            "user_id" => Auth::user()->id
        ]);

        if($course) {
            $idCategory = explode(",", $request->category_id);
            $course->categories()->attach($idCategory);
            return redirect()->route("course.index");
        }
    }

    public function showCourses($id) {
        $course = Course::find($id);

        return view("user.dashboard.courses.update-courses", [
            "course" => $course,
            "title" => "Course"
        ]);
    }

    public function updateCourses(CourseRequest $request, $id) {
        $course = Course::find($id);
        if($request->image_uri) {
            //Eliminar la imagen previa si existe
            if(Storage::disk('public')->exists("images/".$course->image_uri)) {
                Storage::disk('public')->delete("images/".$course->image_uri);
            }
            //Generacion del nombre de la imagen
            $extension = $request->image_uri->getClientOriginalExtension();
            $imageName = md5(uniqid(rand(), true)).".". $extension;
            //Leer y guardar la imagen en el archiuvo
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->image_uri);
            $image->cover(306, 204);
            $image->save(storage_path("app/public/images/". $imageName));
        } else {
            $imageName = $course->image_uri;
        }

        if($course) {
            $course->title = $request->title;
            $course->description = $request->description;
            $course->price = $request->price;
            $course->image_uri = $imageName;
            $course->save();

            $rtrimIdCategory = rtrim($request->category_id, ",");
            $idCategory = explode(",", $rtrimIdCategory);
            CategoryCourse::where('course_id', $course->id)->delete();
            foreach ($idCategory as $key => $value) {
                CategoryCourse::create([
                    "category_id" => $value,
                    "course_id" => $course->id
                ]);
            }
            return redirect()->route("course.index");
        }
    }

    public function deleteCourses($id) {
        $course = Course::find($id);
        //Eliminar la imagen previa
        if(Storage::disk('public')->exists("images/".$course->image_uri)) {
            Storage::disk('public')->delete("images/".$course->image_uri);
        }
        $course->categories()->detach();
        $course->delete();
        return redirect()->route("course.index");
    }

    public function course($url, $id) {
        $course = Course::find($id)->where("url", $url)->get();
        $lessons = Lesson::where("course_id", $course[0]->id)->get();

        return view("user.dashboard.courses.show-course", [
            "title" => "Courses",
            "lessons" => $lessons,
            "course" => $course[0]
        ]);
    }
    public function watchCourse($courseUrl, $lesson) {
        $course = Course::where("url", $courseUrl)->get();
        $lessonVideo = Lesson::find($lesson);
        return view("user.overview-courses", [
            "course" => $course[0],
            "lessonVideo" => $lessonVideo
        ]);
    }
}
