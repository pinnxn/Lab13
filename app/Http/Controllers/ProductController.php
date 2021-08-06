<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function list()
    {
        $products = Product::all();

        return view('product.list',[

            'products' => $products
        ]);
    }

    public function detail($code){
      $product = Product::where('code',$code)->first();

      return view('product.detail',[
        'product'=>$product,
      ]);
    }
}
