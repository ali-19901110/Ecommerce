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
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('backend.pages.category.index');
        // $categoriesFromDB = Category::all();
        // // dd($categoriesFromDB);
        // return view('backend.pages.category.index', compact('categoriesFromDB'));
    }

    // public function categoryDataTable()
    // {
    //     $categories = Category::all();

    //     return DataTables::of($categories)
    //         ->addColumn('Category_id', function ($category) {
    //             return $category->id;
    //         })->addColumn('Category', function ($category) {
    //             return $category->name;
    //         })->addColumn('Slug', function ($category) {
    //             return $category->slug;
    //         })->addColumn('Date', function ($category) {
    //             return $category->created_at;
    //         })->addColumn('Action', function ($category) {
    //             return ' 
    //            <button type="button" class="btn btn-danger btn-sm delete-btn" 
    //             data-id="' . $category->id . '" 
    //             data-name="' . e($category->name) . '">
    //                 Delete
    //             </button>
    //            <a href="/admin/categories/' . $category->id . '/edit" 
    //             class="btn btn-info btn-sm edit-btn" 
    //             data-id="' . $category->id . '" 
    //             data-name="' . e($category->name) . '">
    //             Edit
    //         </a>';
    //         })->rawColumns(['Action']) // <- Tell DataTables not to escape this column
    //         ->make(true);
    // }


    public function create()
    {
        return view('backend.pages.category.create');
    }
    public function store(StoreCaegoryRequest $request)
    {
        try {
            $data = $request->validated();
            Category::create($data);
            return response()->json([
                'message' => 'Category created successfully',
                'status' => 'success'
            ],201);
        } catch (Exception $e) {
             return response()->json([
            'message' => 'Failed to create category',
            'error' => $e->getMessage(),
        ], 500);
        }

        // Validate the request
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'slug' => 'required|string|max:255|unique:categories,slug',
        //     'description' => 'nullable|string',
        //     'image' => 'nullable|string',
        //     'is_active' => 'required|boolean',
        //     'sort_order' => 'integer|min:0',
        //     'meta_title' => 'nullable|string|max:255',
        //     'meta_description' => 'nullable|string|max:500'
        // ]);

        // try {
        //     Category::create([
        //         'name' => $validated['name'],
        //         'slug' => $validated['slug'],
        //         'description' => $validated['description'] ?? null,
        //         'image' => $validated['image'] ?? null,
        //         'is_active' => $validated['is_active'],
        //         'sort_order' => $validated['sort_order'],
        //         'meta_title' => $validated['meta_title'] ?? null,
        //         'meta_description' => $validated['meta_description'] ?? null,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);

        //     if ($request->expectsJson()) {
        //         return response()->json([
        //             'message' => 'Category created successfully!',
        //             'redirect' => route('categories.index')
        //         ], 201);
        //     }

        //     return redirect()->route('categories.index')->with('success', 'Category created successfully!');
        // } catch (Exception $e) {
        //     Log::error('Error creating category: ' . $e->getMessage());

        //     if ($request->expectsJson()) {
        //         return response()->json([
        //             'message' => 'Something went wrong',
        //             'error' => $e->getMessage()
        //         ], 500);
        //     }

        //     return redirect()->back()->withErrors('Failed to create category.');
        // }
    }

    public function edit(Category $category)
    {

        return response()->json($category);
    }

    public function update(UpdateCaegoryRequest $request,  Category $category)
    {

        $validatedData = $request->validated(); // only validated data

        $category->update($validatedData);

        return response()->json([
            'message' => 'Category updated successfully'
        ]);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
