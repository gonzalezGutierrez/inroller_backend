<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{

    public function __construct () {
        $this->product = new Product();
    }

    public function index(Request $request) {

        try {

            $categoryId = $request->category_id;
            $is_numeric = is_numeric($categoryId);

            if (!$is_numeric && $categoryId != null ) {
                return response()->json(['msg'=>'El valor de la categoria no es correcto']);
            }

            $category = Category::find($request->category_id);

            $categoryId = $category == null ? null : $category->id;

            $products = $this->product->getProducts($categoryId)->get();

            if($category) {
                return response()->json([
                    'all'=>false,
                    'category'=>[
                        'id'=>$category->id,
                        'name'=>$category->name,
                        'image'=>$category->url_image,
                        'products_count'=>$products->count(),
                        'products_list'=>$products
                    ],
                ]);
            }

            return response()->json([
                'all'=>true,
                'products_count'=>$products->count(),
                'products_list'=>$products
            ],200);

        }catch (\Exception $e) {
            return response()->json([
                'msg'=>'Ocurrio un error al obtener los productos, Error: '.$e->getMessage(),
                'codigo de error'=> $e->getCode(),
            ],500);
        }


    }
    public function show($idProduct) {
        $is_numeric = is_numeric($idProduct);
        if (!$is_numeric) {
            return response()->json(['msg'=>$idProduct.' No es un valor valido'],500);
        }
        return response()->json($this->product->getWithProductId($idProduct),200);
    }

}
