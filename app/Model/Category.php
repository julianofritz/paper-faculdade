<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorie';
    protected $fillable = [
        'name'
    ];

    public function getCategories()
    {
        return $this->orderBy('id', 'DESC')->get();
    }

    public function getCategoryByName($name, $notId = 0)
    {
        return $this->where('name', $name)
            ->where('id', '!=', $notId)
            ->first();
    }

    public function getCategoryById($id)
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
