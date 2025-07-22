<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\StoreSubcategoryRequest;
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
        // $subcategoriesFromDB = Subcategory::all();
        // return view('backend.pages.subcategory.index', compact('subcategoriesFromDB'));
        return $subcategoryDataTable->render('backend.pages.subcategory.index');
    }

    public function create()
    {
        $allcategories = Category::with('subcategories')->get();
        // dd($allcategories);
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

        // Validation Form
        // $request->validate([

        // ]);


        // try {
        //     //dd('test');
        //     Subcategory::create([
        //         'name' => $request->input('name'),
        //         'category_id' => $request->input('category_id'),
        //         'slug' => $request->input('slug'),
        //         'description' => $request->input('description'),
        //         'image' => $request->input('image'),
        //         'is_active' => $request->input('is_active'),
        //         'sort_order' => $request->input('sort_order'),
        //         'meta_title' => $request->input('meta_title'),
        //         'meta_description' => $request->input('meta_description'),
        //         'created_at' => now(),
        //         'updated_at' => now(),

        //     ]);
        //     //dd($obj);
        // } catch (Exception $e) {
        //     Log::error('Error creating category: ' . $e->getMessage());
        // }

        // return redirect()->route('subcategories.index');
    }

    public function edit(Subcategory $subcategory)
    {
        $allcategories = Category::with('subcategories')->get();
        return view('backend.pages.subcategory.edit', compact('subcategory', 'allcategories'));
    }
    public function update(Request $request, Subcategory $subcategory)
    {
        // dd($category);

        // Validation Form
        try {
            $validated =  $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('subcategories', 'slug')->ignore($subcategory),
                ],
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'is_active' => 'required|boolean',
                'sort_order' => 'integer|min:0',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500'
            ]);
            $subcategory->update($validated);
            return redirect()->route('subcategories.index')->with('success', 'Updated!');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            //return redirect()->back()->with('error', 'Failed!');
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating the category.');
        }
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response()->json(['message' => 'subCategory deleted successfully']);
    }
}
