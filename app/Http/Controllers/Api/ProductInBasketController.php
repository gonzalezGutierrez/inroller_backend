<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductInBasket;
use Illuminate\Http\Request;

class ProductInBasketController extends Controller
{

    public function __construct() {
        $this->productInBasket = new ProductInBasket();
    }

    public function store(Request $request) {

        try {

            //verificar si el producto esta en la cesta

            $productId = $request->product_id;
            $amount    = $request->amount;
            $width     = $request->width;
            $height    = $request->height;

            $product = Product::findOrFail($productId);

            $isProductInBasket = $this->productInBasket->getProduct($product);


        }catch (\Exception $e) {

        }

    }

}
