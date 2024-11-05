<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\ClassResource;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = StudentResource::collection(Student::paginate(10));
        
        return inertia(
            'Student/Index', [
                'students' => $students
            ]
        );
    }

    public function create()
    {
        $classes = ClassResource::collection(Classes::all());

        return inertia('Student/Create', [
            'classes' => $classes
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route('students.index');
    }
}
