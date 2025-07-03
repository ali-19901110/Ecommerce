<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categoriesFromDB = Category::all();
        // dd($categoriesFromDB);
        return view('backend.pages.category.index', compact('categoriesFromDB'));
    }
    public function create()
    {
        return view('backend.pages.category.create');
    }
    public function store(Request $request)
    {

        // Validation Form
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'is_active' => 'required|boolean',
            'sort_order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        //dd($request);
        // Insert to DB
        try {
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'image' => $request->image,
                'is_active' => $request->is_active,
                'sort_order' => $request->sort_order,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        } catch (Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
        }

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('backend.pages.category.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        // dd($category);

        // Validation Form
        try {
            $validated =  $request->validate([
                'name' => 'required|string|max:255',
                'slug' => (string)'required|string|max:255|unique:categories,slug,' . $category->id,
                'description' => 'nullable|string',
                'image' => 'nullable|string',
                'is_active' => 'required|boolean',
                'sort_order' => 'integer|min:0',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500'
            ]);
            $category->update($validated);
            return redirect()->route('categories.index')->with('success', 'Updated!');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e){
            //return redirect()->back()->with('error', 'Failed!');
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating the category.');
        }
    }
    public function destroy(Category $category){
        $category->products()->delete();
        $category->delete();
        return redirect()->route('categories.index');
    }
}
