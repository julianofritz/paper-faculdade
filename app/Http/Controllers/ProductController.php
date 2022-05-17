<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->getProducts();
        return view('product.index', compact('products'));
    }
    
    public function create()
    {
        return view('product.create');
    }

}
