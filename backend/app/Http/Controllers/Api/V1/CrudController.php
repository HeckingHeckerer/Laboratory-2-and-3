<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    protected string $model;
    protected array $rules = [];
    public function index(Request $request) { return response()->json(['success' => true, 'data' => ($this->model)::paginate(min((int) $request->input('per_page', 20), 100))]); }
    public function store(Request $request) { try { $item = ($this->model)::create($request->validate($this->rules)); return response()->json(['success' => true, 'data' => $item], 201); } catch (\Illuminate\Database\QueryException $e) { return response()->json(['success'=>false,'message'=>'Duplicate or conflicting record.'],409); } }
    public function show(string $id) { return response()->json(['success' => true, 'data' => ($this->model)::findOrFail($id)]); }
    public function update(Request $request, string $id) { $item = ($this->model)::findOrFail($id); $rules = array_map(fn($rule) => is_string($rule) ? preg_replace('/\|?unique:[^|]+/', '', $rule) : $rule, $this->rules); try { $item->update($request->validate($rules)); return response()->json(['success' => true, 'data' => $item]); } catch (\Illuminate\Database\QueryException $e) { return response()->json(['success'=>false,'message'=>'Duplicate or conflicting record.'],409); } }
    public function destroy(string $id)
    {
        try {
            ($this->model)::findOrFail($id)->delete();
        } catch (\Illuminate\Database\QueryException $exception) {
            if ((string) $exception->getCode() === '23000' && str_contains(strtolower($exception->getMessage()), 'foreign key constraint')) {
                return response()->json(['success' => false, 'message' => 'This record cannot be deleted because it is still in use.'], 409);
            }
            throw $exception;
        }
        return response()->noContent();
    }
}
