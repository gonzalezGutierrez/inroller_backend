<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    private $selectionDefault = ['id','url_image as image','name as category'];

    public function getAll() {
        return $this->actives()->orderWithAttribute('id','desc');
    }
    public function getWithCategoryId($idCategory){
        return $this->selection($this->selectionDefault)->findOrFail($idCategory);
    }
    public function scopeActives($query) {
        return $query->where('status',true)->selection($this->selectionDefault);
    }
    public function scopeOrderWithAttribute($query,$atribute,$order) {
        return $query->orderBy($atribute,$order);
    }
    public function scopeSelection($query,$attributes) {
        return $query->select($attributes);
    }

}
