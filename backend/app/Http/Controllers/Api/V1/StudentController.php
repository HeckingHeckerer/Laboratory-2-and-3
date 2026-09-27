<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends CrudController
{
    protected string $model = Student::class;
    protected array $rules = ['student_number'=>'required|string|max:50|unique:students,student_number','first_name'=>'required|string|max:255','middle_name'=>'nullable|string|max:255','last_name'=>'required|string|max:255','email'=>'nullable|email','program_id'=>'required|exists:programs,id','year_level'=>'required|integer|min:1|max:6','status'=>'required|in:Regular,Irregular,Graduated,Inactive','contact_number'=>'nullable|string|max:50','address'=>'nullable|string'];
}

