<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct() {
        $this->category = new Category();
    }

    public function index() {
        $categories = $this->category->getAll()->get();
        return response()->json([
            'categories_count'=>$categories->count(),
            'categories_list'=>$categories
        ],200);
    }
    public function show($idCategory) {
        return response()->json($this->category->getWithCategoryId($idCategory),200);
    }

}
