<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){

        $categories = Category::select('id', 'label')->orderBy('label', 'ASC')->get();

        return response()->json($categories);
    }
}
