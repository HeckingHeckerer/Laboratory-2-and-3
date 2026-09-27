<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends CrudController
{
    protected string $model = Course::class;
    protected array $rules = ['course_code'=>'required|string|max:50|unique:courses,course_code','course_title'=>'required|string|max:255','units'=>'required|integer|min:1|max:10','description'=>'nullable|string','status'=>'required|in:Active,Inactive'];
}

