<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductFrontendController extends Controller
{
    public function singleCategory($id){
        //dd($id);
        $subProducts = Product::where('subcategory_id',$id)->get();
        return view('frontend.pages.index', compact('subProducts'));
    }
}
