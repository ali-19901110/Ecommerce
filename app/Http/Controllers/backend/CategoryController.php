<?php

namespace App\Http\Controllers\backend;

use App\DataTables\CategoryDataTable;
use Exception;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\StoreCaegoryRequest;
use App\Http\Requests\backend\UpdateCaegoryRequest;
use Yajra\DataTables\Facades\DataTables;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('backend.pages.category.index');
    }


    // public function create()
    // {
    //     return view('backend.pages.category.create');
    // }

    public function store(StoreCaegoryRequest $storeCaegoryRequest)
    {
        try {
            DB::beginTransaction();
            $data = $storeCaegoryRequest->validated();
            Category::create($data);
            DB::commit();
            return response()->json([
                'message' => 'Category created successfully',
                'status' => 'success'
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Create Category Failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Category $category)
    {

        return response()->json($category);
    }
    public function getAllCategories()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return response()->json($categories);
    }
    public function update(UpdateCaegoryRequest $request,  Category $category)
    {
        try {
            $validatedData = $request->validated(); // only validated data
            $category->update($validatedData);

            return response()->json([
                'message' => 'Category updated successfully',
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
