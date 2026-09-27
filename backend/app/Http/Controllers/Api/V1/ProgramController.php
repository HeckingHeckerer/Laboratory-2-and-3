<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends CrudController
{
    protected string $model = Program::class;
    protected array $rules = ['code'=>'required|string|max:50|unique:programs,code','name'=>'required|string|max:255','description'=>'nullable|string','status'=>'required|in:Active,Inactive'];
}

