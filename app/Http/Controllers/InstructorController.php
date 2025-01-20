<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructors;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructors::all();
        return response()->json([
            'success' => true,
            'data' => $instructors
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
            'expertise' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $instructor = Instructors::create($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $instructor
        ]);
    }

    public function update(Request $request, Instructors $instructor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email,'.$instructor->id,
            'expertise' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $instructor->update($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $instructor
        ]);
    }

    public function destroy(Instructors $instructor)
    {
        $instructor->delete();
        return response()->json(['success' => true]);
    }
}