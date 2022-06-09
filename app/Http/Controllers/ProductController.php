<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $categories = Category::orderBy('name', 'ASC')->get();
        $categorieOptions = $categories;

        return view('product.create', compact('categorieOptions'));
    }

    public function remove($id)
    {
        $product = $this->product->getProductById($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Produto não encontrado!');
        }

        $product->value = 'R$ ' . $product->value;
        $product->value = str_replace('.', ',', $product->value);

        $categories = Category::orderBy('name', 'ASC')->get();
        $categorieOptions = $categories;

        return view('product.remove', compact('product','categorieOptions'));
    }

    public function edit($id)
    {
        $product = $this->product->getProductById($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Produto não encontrado!');
        }

        $product->value = 'R$ ' . $product->value;
        $product->value = str_replace('.', ',', $product->value);

        $categories = Category::orderBy('name', 'ASC')->get();
        $categorieOptions = $categories;

        return view('product.update', compact('product','categorieOptions'));
    }

    public function store(Request $request)
    {
        $name = trim($request->post('name'));
        $cat = trim($request->post('categorie_id'));

        $value = ltrim($request->post('value'), 'R$ ');
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        
        // nome em branco
        if (empty($name)) {
            return back()
                ->withErrors('Nome do produto precisa ser informado.')
                ->withInput();
        }

        // nome já existe no banco
        if ($this->product->getProductByName($name)) {
            return back()
                ->withErrors('Nome do produto já em uso.')
                ->withInput();
        }

        // categoria em branco
        if ($cat == 0) {
            return back()
                ->withErrors('Categoria precisa ser selecionada.')
                ->withInput();
        }

        $create = $this->product->insert(array('name' => $name, 'value' => $value, 'categorie_id' => $cat));

        if ($create) {
            return redirect()->route('product.index')->with('success', 'Produto cadastrado!');
        }

        return back()
            ->withErrors('Erro para cadastrar.')
            ->withInput();
    }

    public function update(Request $request)
    {
        $id = trim($request->post('id'));
        $name = trim($request->post('name'));
        $categorie_id = trim($request->post('categorie_id'));

        $value = ltrim($request->post('value'), 'R$ ');
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        
        // código do produto em branco
        if (empty($id)) {
            return back()
                ->withErrors('Código do produto não encontrado.')
                ->withInput();
        }

        // nome em branco
        if (empty($name)) {
            return back()
                ->withErrors('Nome do produto precisa ser informado.')
                ->withInput();
        }

        // código da categoria em branco
        if (empty($categorie_id)) {
            return back()
                ->withErrors('Categoria não selecionada.')
                ->withInput();
        }

        // produto não existe no banco
        $product = $this->product->getProductById($id);
        if (!$product) {
            return back()
                ->withErrors('Produto não encontrado!')
                ->withInput();
        }

        // nome já existe no banco
        if ($this->product->getProductByName($name, $id)) {
            return back()
                ->withErrors('Nome do produto já em uso.')
                ->withInput();
        }

        $data = array('name' => $name, 'value' => $value, 'categorie_id' => $categorie_id);
        $update = $this->product->edit($data, $id);

        Log::info("[UPDATE_PRODUCT]\nbefore="  .json_encode($product) . "\nafter=" . json_encode($data));

        if ($update) {
            return redirect()->route('product.index')->with('success', 'Produto atualizado!');
        }

        return back()
            ->withErrors('Erro para cadastrar.')
            ->withInput();
    }

    public function delete(Request $request)
    {
        $product_id = trim($request->post('id'));

        // código da categoria em branco
        if (empty($product_id)) {
            return back()
                ->withErrors('Código do produto não encontrado.')
                ->withInput();
        }

        // produto não existe no banco
        $product = $this->product->getProductById($product_id);
        if (!$product) {
            return back()
                ->withErrors('Producto não encontrado!')
                ->withInput();
        }

        Log::info('[DELETE_PRODUCT]' . json_encode($product));

        $update = $this->product->remove($product_id);

        if ($update) {
            return redirect()->route('product.index')->with('success', 'Produto excluído!');
        }

        return back()
            ->withErrors('Erro para excluir.')
            ->withInput();
    }
}
