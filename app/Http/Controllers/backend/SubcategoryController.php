<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategoriesFromDB = Subcategory::all();
        return view('backend.pages.subcategory.index', compact('subcategoriesFromDB'));
    }

    public function create()
    {
        $allcategories = Category::with('subcategories')->get();
        // dd($allcategories);
        return view('backend.pages.subcategory.create', compact('allcategories'));
    }

    public function store(Request $request)
    {

        // Validation Form
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'slug' => 'required|string|max:255|unique:subcategories,slug',
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
            //dd('test');
             Subcategory::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
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
            //dd($obj);
        } catch (Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
        }

        return redirect()->route('subcategories.index');
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
                'slug' => (string)'required|string|max:255|unique:categories,slug,' . $subcategory->id,
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

     public function destroy(Subcategory $subcategory){
        $subcategory->delete();
        return redirect()->route('subcategories.index');
    }
}
