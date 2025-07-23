<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\StoreSubcategoryRequest;
use App\Http\Requests\backend\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SubcategoryController extends Controller
{
    public function index(SubcategoryDataTable $subcategoryDataTable)
    {
        return $subcategoryDataTable->render('backend.pages.subcategory.index');
    }

    public function create()
    {
        $allcategories = Category::with('subcategories')->get();
        return view('backend.pages.subcategory.create', compact('allcategories'));
    }

    public function store(StoreSubcategoryRequest $storeSubcategoryRequest)
    {

        try {
            DB::beginTransaction();
            $data = $storeSubcategoryRequest->validated();
            Subcategory::create($data);
            DB::commit();
            return response()->json([
                'message' => 'subCategory created successfully',
                'status' => 'success'
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Create subCategory Failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Subcategory $subcategory)
    {
        return response()->json($subcategory);
    }
    public function update(UpdateSubcategoryRequest $updateSubcategoryRequest, Subcategory $subcategory)
    {
        // dd($category);

        try {
            DB::beginTransaction();
            $validatedData = $updateSubcategoryRequest->validated(); // only validated data
            $subcategory->update($validatedData);
            DB::commit();
            return response()->json([
                'message' => 'subCategory updated successfully',
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Create subCategory Failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create subcategory',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response()->json(['message' => 'subCategory deleted successfully']);
    }
}
