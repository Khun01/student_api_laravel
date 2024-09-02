<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // $student = Student::create($request->all());
    //     // return response()->json($student, 201);
    //     $fields = $request->validate([
    //         'first_name' => 'required|max:255',
    //         'last_name' => 'required|max:255',
    //         'course' => 'required|max:255',
    //         'year' => 'required|max:255',
    //         'enrolled' => 'required|boolean',
    //     ]);

    //     $students = Student::create($fields);
    //     return response()->json($students, 200);
    // }

    public function store(Request $request)
    {
        try {
            $fields = $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'course' => 'required|max:255',
                'year' => 'required|max:255',
                'enrolled' => 'required|boolean',
            ]);

            $student = Student::create($fields);
            return response()->json($student, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to add student',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $students = Student::find($id);

        if(!$students){
            return response()->json(['error' => 'Student not found'], 404);
        };

        $fields = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'course' => 'required|max:255',
            'year' => 'required|max:255',
            'enrolled' => 'required|boolean',
        ]);

        $students->update($fields);

        return response()->json($students, 200);

    }

    public function show(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students = Student::find($id);

        if(!$students){
            return response()->json(['error', 'Student not found'], 404);
        }

        $students->delete();

        return response()->json(['message', 'Student deleted successfully'], 200);
    }
}
