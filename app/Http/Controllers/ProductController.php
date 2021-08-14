<?php

namespace App\Http\Controllers;


use App\Models\Product;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;


class ProductController extends SearchableController
{

    public function getQuery(){
      return  Product::orderBy('code');
    }

    public function preparSearch($data)
    {
      $data = parent::prepareSearch($data);
      $data = array_merge([
        'minPrice'=> null,
        'maxPrice'=> null,
      ], $data);
      return $data;
    }

    public function filterByPrice($query, $minPrice, $maxPrice)
    {
      if($minPrice != null){
        $query->where('price','>=', $minPrice);
      }
      if($maxPrice != null){
        $query->where('price','<=', $maxPrice);
      }

      return $query;
    }

    public function search($data){
      $query = parent::search($data);
      $query = $this->filterByPrice($query, $data['minPrice'], $data['maxPrice']);

      return $query;
    }

    public function list(ServerRequestInterface $request)
    {
      $data = $this->preparSearch($request->getQueryParams());
      $products = $this->search($data);
       
       return view('product.list',[
         'products' => $products->paginate(2),
         'data' => $data,
       ]);
    }

    public function detail($code){
      $product = Product::where('code',$code)->first();

      return view('product.detail',[
        'product'=>$product,
      ]);
    }

    public function createForm(){
      return view('product.create');
    }

    public function create(ServerRequestInterface $request)
    {  
      $data = $request->getParsedBody();
      Product::create($data);

      return redirect()->route('product-list');
    }

    public function updateForm($code)
    {
       $product = Product::where('code',$code)->first();

       return view('product.update',[
         'product' => $product,
       ]);
    }

    public function update(ServerRequestInterface $request , $code)
    {
     $data = $request->getParsedBody();

     $product = Product::where('code',$code)->first();

     $product->update($data);

     return redirect()->route('product-detail',['code'=> $product['code']]);
    }

    public function delete($code)
    {
      $product = Product::where('code',$code)->first();

      $product->delete();

      return redirect()->route('product-list');
    }
}
