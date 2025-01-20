<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Instructors;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;


// CourseController.php
class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'instructor'])->get();
        $categories = Categories::all();
        $instructors = Instructors::all();
    
    return view('index', compact('courses', 'categories', 'instructors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,_id',
            'instructor_id' => 'required|exists:instructors,_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course = Course::create($request->all());
        $course->load(['category', 'instructor']);
        
        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,_id',
            'instructor_id' => 'required|exists:instructors,_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course->update($request->all());
        $course->load(['category', 'instructor']);
        
        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['success' => true]);
    }
}