<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Database\QueryException;

class ShopController extends SearchableController
{
  public $title = 'Shop';

    public function getQuery(){
      return Shop::orderBy('code');
    }

    public function list(ServerRequestInterface $request)
    {
      $data = $this->prepareSearch($request->getQueryParams());
      $shops = $this->search($data)->withCount('products');
      session()->put('bookmark.shop-detail', $request->getUri());

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
     try{
      $data = $request->getParsedBody();
      $shop = Shop::create($data);
      return redirect()->route('shop-list')->with('status',"Shop {$shop->code} was created.");
     }
     catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }
      // return redirect()->route('shop-list');
    }

    public function showProduct(ServerRequestInterface $request, ProductController $productController, $code ){
      $shop = Shop::where('code',$code)->first();
      $data = $productController->prepareSearch($request->getQueryParams());
      $query = $productController->filterBySearch($shop->products(), $data);
      session()->put('bookmark.product.detail', $request->getUri());

      return view('shop.product',[
        'title' => "Shop {$shop->code} : Product",
        'shop' =>$shop,
        'data' => $data,
        'products' => $query->paginate(5),
      ]);
    }

    public function addProductForm(ServerRequestInterface $request,  ProductController $productController, $code)
  {
    $shop = $this->find($code);
    $query = Product::orderBy('code')->whereDoesntHave('shops', function ($innerQuery) use ($shop) {
      return $innerQuery->where('code', $shop->code);
    });
    $data =$productController->prepareSearch($request->getQueryParams());
    $query =$productController->filterBySearch($query, $data);

    return view('shop.add-product-form', [
      'title' => "{$this->title} {$shop->code} : Add Product", 'data' => $data,
      'shop' => $shop,
      'products' => $query->paginate(5),
    ]);
  }

  function addProduct(ServerRequestInterface $request,  ProductController $productController, $code) 
  { 
   try{
    $shop = $this->find($code); 
    $data = $request->getParsedBody(); 
    $product =$productController->find($data['product']); 
    $shop->products()->attach($product); 
    return redirect()->route('shop-list')->with('status',"Product {$product->code} was added to Shop {$shop->code}.");
    return redirect()->back(); 
   }catch (QueryException $excp) {
    return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
    ]);
  }
  } 

  function removeProduct( $shopCode,$productCode) { 
   try{
    $shop = $this->find($shopCode); 
    $product = $shop->products() ->where('code', $productCode)->firstOrFail() ; 
    $shop->products()->detach($product); 
    return redirect()->route('shop-list')->with('status',"Product {$product->code} was removed to Shop {$shop->code}.");
    return redirect()->back(); 
   } catch (QueryException $excp) {
    return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
    ]);
  }
    } 

public function filterByTerm($query, $term)
 {
        if(!empty($term)) {
            $words = preg_split('/\s+/', $term);

            foreach($words as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                            ->where('name','LIKE',"%{$word}%")
                            ->orWhere('code','LIKE',"%{$word}%")
                            ->orWhere('owner','LIKE',"%{$word}%");
                });
            }
        }

        return $query;
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
    try{
      $data = $request->getParsedBody();

      $shop = Shop::where('code',$code)->first();
 
      $shop->update($data);
 
      return redirect()->route('shop-list')->with('status',"Shop {$shop->code} was updated.");
    } catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }
    //  return redirect()->route('shop-detail',['code'=> $shop['code']]);
    }

    public function delete($code)
    {
     try{
      $shop = Shop::where('code',$code)->first();

      $shop->delete();

      return redirect()->route('shop-list')->with('status',"Shop {$shop->code} was deleted.");
     }catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }
    }
}
