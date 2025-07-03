<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductFrontendController extends Controller
{

    public function index(){
        $products = Product::all();
        $subcategories = Subcategory::all();
        //dd($Products);
        return view('frontend.pages.index',compact('products','subcategories'));
    }

    public function filterBySubcategory($id){
        //dd($id);
        $products = Product::where('subcategory_id',$id)->get();
        return view('frontend.pages.index', compact('products'));
    }
}
