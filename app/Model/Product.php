<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'value',
        'categorie_id'
    ];

    public function getProducts()
    {
        $products = Product::join('categorie', 'product.categorie_id', '=', 'categorie.id' )
                            ->orderBy('id', 'DESC')->get(['product.*', 'categorie.name as name_cat']);

        return $products;
    }
    
    public function getProductByName($name, $notId = 0)
    {
        return $this->where('name', $name)
            ->where('id', '!=', $notId)
            ->first();
    }

    public function getProductById($id)
    {
        return $this->find($id);
    }

    public function insert($data)
    {
        return $this->create($data);
    }

    public function edit($data, $id)
    {
        return $this->where('id', $id)->update($data);
    }

    public function remove($id)
    {
        return $this->where('id', $id)->delete();
    }
}
