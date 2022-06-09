<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function create()
    {
        return view('category.create');
    }

    public function remove($id)
    {
        $category = $this->category->getCategoryById($id);

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Categoria não encontrada!');
        }

        return view('category.remove', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->category->getCategoryById($id);

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Categoria não encontrada!');
        }

        return view('category.update', compact('category'));
    }

    public function store(Request $request)
    {
        $name = trim($request->post('name'));
        // nome em branco
        if (empty($name)) {
            return back()
                ->withErrors('Nome da categoria precisa ser informado.')
                ->withInput();
        }

        // nome já existe no banco
        if ($this->category->getCategoryByName($name)) {
            return back()
                ->withErrors('Nome da categoria já em uso.')
                ->withInput();
        }

        $create = $this->category->insert(array('name' => $name));

        if ($create) {
            return redirect()->route('category.index')->with('success', 'Categoria cadastrada!');
        }

        return back()
            ->withErrors('Erro para cadastrar.')
            ->withInput();
    }

    public function update(Request $request)
    {
        $name = trim($request->post('name'));
        $category_id = trim($request->post('category_id'));

        // código da categoria em branco
        if (empty($category_id)) {
            return back()
                ->withErrors('Código da categoria não encontrado.')
                ->withInput();
        }

        // nome em branco
        if (empty($name)) {
            return back()
                ->withErrors('Nome da categoria precisa ser informado.')
                ->withInput();
        }

        // categoria não existe no banco
        $category = $this->category->getCategoryById($category_id);
        if (!$category) {
            return back()
                ->withErrors('Categoria não encontrada!')
                ->withInput();
        }

        // nome já existe no banco
        if ($this->category->getCategoryByName($name, $category_id)) {
            return back()
                ->withErrors('Nome da categoria já em uso.')
                ->withInput();
        }

        $data = array('name' => $name);
        $update = $this->category->edit($data, $category_id);

        Log::info("[UPDATE_CATEGORY]\nbefore="  .json_encode($category) . "\nafter=" . json_encode($data));

        if ($update) {
            return redirect()->route('category.index')->with('success', 'Categoria atualizada!');
        }

        return back()
            ->withErrors('Erro para cadastrar.')
            ->withInput();
    }

    public function delete(Request $request)
    {
        $category_id = trim($request->post('category_id'));

        // código da categoria em branco
        if (empty($category_id)) {
            return back()
                ->withErrors('Código da categoria não encontrado.')
                ->withInput();
        }

        // categoria não existe no banco
        $category = $this->category->getCategoryById($category_id);
        if (!$category) {
            return back()
                ->withErrors('Categoria não encontrada!')
                ->withInput();
        }

        Log::info('[DELETE_CATEGORY]' . json_encode($category));

        $update = $this->category->remove($category_id);

        if ($update) {
            return redirect()->route('category.index')->with('success', 'Categoria excluída!');
        }

        return back()
            ->withErrors('Erro para excluir.')
            ->withInput();
    }
}
