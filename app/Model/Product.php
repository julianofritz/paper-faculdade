<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'nome',
        'value',
        'categorie_id'
    ];

    public function getProducts()
    {
        return $this->get();
    }
}
