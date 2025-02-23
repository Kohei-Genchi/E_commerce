<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View{
        $products=$category->products()->paginate(12);
        return view('categories.show',compact('category','products'));
    }
}
