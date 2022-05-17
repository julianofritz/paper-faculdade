<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->getCategories();
        return view('category.index', compact('categories'));
    }
}
