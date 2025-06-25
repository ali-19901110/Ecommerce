<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class ProductController extends Controller
{
    public function index()
    {
        $productsFromDB = Product::all();
        return view('backend.pages.product.index', compact('productsFromDB'));
    }

    public function create()
    {
        $allcategories = Category::with('products')->get();
        //dd($allcategories);
        $allsubcategories = Subcategory::with('products')->get();
        // dd($allcategories);
        return view('backend.pages.product.create', compact('allcategories', 'allsubcategories'));
    }

    public function store(Request $request)
    {
        //dd($request->has('manage_stock'));
        $request->merge([
            'manage_stock' => $request->has('manage_stock')
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:subcategories,slug',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'sku' => 'required|string|max:100|unique:products,sku',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'manage_stock' => 'nullable|boolean',
            'stock_status' => 'required|in:in_stock,out_of_stock,on_backorder',
            'sale_price' => 'nullable|numeric|min:0|max:99999999.99',
            'cost_price' => 'nullable|numeric|min:0|max:99999999.99',
            'stock_quantity' => 'required|integer|min:0',
            'min_quantity' => 'required|integer|min:1',
            //  'sort_order' => 'integer|min:0',
            'image' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0|max:999999.99',
            'gallery' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'description' => 'nullable|string',
            'rating_average' => 'required|numeric|min:0|max:5',
            'rating_count' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'short_description' => 'nullable|string'
        ]);
        try {

            // Validation Form
            //dd('test');
            $obj = Product::create([
                'name' => $request->name,
                'dimensions' => $request->dimensions,
                'slug' => $request->slug,
                'price' => $request->price,
                'sku' => $request->sku,
                'is_active' => $request->is_active,
                'is_featured' => $request->is_featured,
                'manage_stock' => $request->has('manage_stock'),
                'stock_status' => $request->stock_status,
                'sale_price' =>  $request->sale_price,
                'cost_price' =>  $request->cost_price,
                'stock_quantity' =>  $request->stock_quantity,
                'min_quantity' =>  $request->min_quantity,
                //  'sort_order' =>  $request->sort_order,
                'image' =>  $request->image,
                'weight' =>  $request->weight,
                'gallery' => $request->file('gallery'),
                'meta_title' =>  $request->meta_title,
                'meta_description' =>  $request->meta_description,
                'description' =>  $request->description,
                'rating_average' =>  $request->rating_average,
                'rating_count' =>  $request->rating_count,
                'category_id' =>  $request->category_id,
                'subcategory_id' =>  $request->subcategory_id,
                'short_description' => $request->short_description,

            ]);
            // dd($obj);
        } catch (Exception $e) {
            //dd('Error: ' . $e->getMessage());
            Log::error('Error creating category: ' . $e->getMessage());
        }

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
         $allcategories = Category::with('products')->get();
        //dd($allcategories);
        $allsubcategories = Subcategory::with('products')->get();
        return view('backend.pages.subcategory.edit', compact('allsubcategories', 'allcategories','allsubcategories'));
    }
   

     public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index');
    }
}
