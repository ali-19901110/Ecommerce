<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategotyFrontendController extends Controller
{
    public function index()
    {
        $subProducts = collect();
        $Categories = Category::all();
       $subcategries = Subcategory::all();
    //    dd($subcategries);
        return view('frontend.pages.index', compact('Categories', 'subcategries', 'subProducts'));
    }
}
