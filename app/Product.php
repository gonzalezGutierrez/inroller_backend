<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{

    private $selectionDefault = [
        'products.id',
        'products.name as product',
        'products.url_image as product_image',
        'products.price as product_price',
        'categories.name as category',
        'categories.url_image as category_image',
        'categories.id as category_id'
    ];

    public function getProducts($categoryId) {
        return $this->getWithCategoryId($categoryId)->goToCategory()->actives()->orderWithAttribute('products.id','desc');
    }
    public function getWithProductId($idCategory){
        $this->addAttribute('products.description');
        return $this->selection($this->selectionDefault)->goToCategory()->findOrFail($idCategory);
    }
    public function removeCategoryAttributes() {
        unset($this->selectionDefault[4]);
        unset($this->selectionDefault[5]);
    }
    public function addAttribute($attribute) {
        $sizeAttributes = count($this->selectionDefault);
        $this->selectionDefault[$sizeAttributes] = $attribute;
    }

    public function scopeActives($query) {
        return $query->where('products.status',true)->selection($this->selectionDefault);
    }
    public function scopeOrderWithAttribute($query,$atribute,$order) {
        return $query->orderBy($atribute,$order);
    }
    public function scopeSelection($query,$attributes) {
        return $query->select($attributes);
    }
    public function scopeGetWithCategoryId($query,$categoryId) {
        if ($categoryId){
            $this->removeCategoryAttributes();
            return $query->where('products.category_id',$categoryId);
        }
        return ;
    }
    public function scopeGoToCategory($query) {
        return $query->join('categories','products.category_id','categories.id');
    }

}
