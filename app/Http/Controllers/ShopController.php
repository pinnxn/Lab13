<?php

namespace App\Http\Controllers;


use App\Models\Shop;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ServerRequestInterface;

class ShopController extends SearchableController
{
    public function getQuery(){
      return Shop::orderBy('code');
    }

    public function list(ServerRequestInterface $request)
    {
      $data = $this->prepareSearch($request->getQueryParams());
      $shops = $this->search($data)->withCount('products');

        return view('Shop.list',[
            'shops' => $shops->paginate(5),
            'data'=> $data,
        ]);
    }


    public function detail($code){
      $shop = Shop::where('code',$code)->first();

      return view('shop.detail',[
        'shop'=>$shop,
      ]);
    }

    public function createForm(){
      return view('shop.create');
    }

    public function create(ServerRequestInterface $request)
    {  
      $data = $request->getParsedBody();
      Shop::create($data);

      return redirect()->route('shop-list');
    }

    public function showProduct(ServerRequestInterface $request, ProductController $productController, $code ){
      $shop = Shop::where('code',$code)->first();
      $data = $productController->prepareSearch($request->getQueryParams());
      $query = $productController->filterBySearch($shop->products(), $data);

      return view('shop.product',[
        'title' => "Shop {$shop->code} : Product",
        'shop' =>$shop,
        'data' => $data,
        'products' => $query->paginate(5),
      ]);
    }


    public function updateForm($code)
    {
       $shop = Shop::where('code',$code)->first();

       return view('shop.update',[
         'shop' => $shop,
       ]);
    }

    public function update(ServerRequestInterface $request , $code)
    {
     $data = $request->getParsedBody();

     $shop = Shop::where('code',$code)->first();

     $shop->update($data);

     return redirect()->route('shop-detail',['code'=> $shop['code']]);
    }

    public function delete($code)
    {
      $shop = Shop::where('code',$code)->first();

      $shop->delete();

      return redirect()->route('shop-list');
    }
}
