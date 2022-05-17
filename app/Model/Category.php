<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorie';
    protected $fillable = [
        'nome',
        'value',
        'categorie_id'
    ];

    public function getCategories()
    {
        return $this->get();
    }
}
