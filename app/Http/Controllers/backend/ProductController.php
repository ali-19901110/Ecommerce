<?php

namespace App\Http\Controllers\backend;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;
use Illuminate\Support\Str;


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
        $allsubcategories = Subcategory::with('products')->get();
        return view('backend.pages.product.create', compact('allcategories', 'allsubcategories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'manage_stock' => $request->has('manage_stock')
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            // 'slug' => 'required|string|max:255|unique:subcategories,slug',
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
            // dd(Str::slug($request->name, '_'));
            $obj = Product::create([
                'name' => $request->input('name'),
                'dimensions' => $request->input('dimensions'),
                'slug' => Str::slug($request->input('name'), '_'),
                'price' => $request->input('price'),
                'sku' => $request->input('sku'),
                'is_active' => $request->input('is_active'),
                'is_featured' => $request->input('is_featured'),
                'manage_stock' => $request->has('manage_stock') ?? 0,
                'stock_status' => $request->input('stock_status'),
                'sale_price' =>  $request->input('sale_price'),
                'cost_price' =>  $request->input('cost_price'),
                'stock_quantity' =>  $request->input('stock_quantity'),
                'min_quantity' =>  $request->input('min_quantity'),
                //  'sort_order' =>  $request->sort_order,
                'image' =>  $request->input('image'),
                'weight' =>  $request->input('weight'),
                'gallery' => $request->file('gallery'),
                'meta_title' =>  $request->input('meta_title'),
                'meta_description' =>  $request->input('meta_description'),
                'description' =>  $request->input('description'),
                'rating_average' =>  $request->input('rating_average'),
                'rating_count' =>  $request->input('rating_count'),
                'category_id' =>  $request->input('category_id'),
                'subcategory_id' =>  $request->input('subcategory_id'),
                'short_description' => $request->input('short_description'),

            ]);
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
        return view('backend.pages.product.edit', compact('allsubcategories', 'allcategories', 'product'));
    }

    public function update(Request $request, Product $product)
    {
        // dd($category);

        // Validation Form
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'dimensions' => 'nullable|string|max:255',

                // FIXED SLUG VALIDATION
                'slug' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'slug')->ignore($product),
                ],

                // FIXED SKU VALIDATION
                'sku' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('products', 'sku')->ignore($product),
                ],

                'is_active' => 'nullable|boolean',
                'is_featured' => 'nullable|boolean',
                'manage_stock' => 'nullable|boolean',
                'stock_status' => 'required|in:in_stock,out_of_stock,on_backorder',
                'sale_price' => 'nullable|numeric|min:0|max:99999999.99',
                'cost_price' => 'nullable|numeric|min:0|max:99999999.99',
                'stock_quantity' => 'required|integer|min:0',
                'min_quantity' => 'required|integer|min:1',
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
            $product->update($validated);
            return redirect()->route('products.index')->with('success', 'Updated!');
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            //return redirect()->back()->with('error', 'Failed!');
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating the category.');
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
