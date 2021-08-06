<?php

namespace App\Http\Controllers;


use App\Models\Shop;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function list()
    {
        $shops = Shop::all();

        return view('Shop.list',[

            'shops' => $shops
        ]);
    }

    public function detail($code){
      $shop = Shop::where('code',$code)->first();

      return view('shop.detail',[
        'shop'=>$shop,
      ]);
    }
}
