<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {



        $categories = \App\Models\Category::paginate(20);


        return view('articles.categories', ['categories' => $categories]);
    }
}

