<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;


class ProductController extends SearchableController
{
  public $title = 'Product';

  public function getQuery()
  {
    return  Product::orderBy('code');
  }

  public function prepareSearch($data)
  {
    $data = parent::prepareSearch($data);
    $data = array_merge([
      'minPrice' => null,
      'maxPrice' => null,
    ], $data);
    return $data;
  }

  public function filterByPrice($query, $minPrice, $maxPrice)
  {
    if ($minPrice != null) {
      $query->where('price', '>=', $minPrice);
    }
    if ($maxPrice != null) {
      $query->where('price', '<=', $maxPrice);
    }

    return $query;
  }

  public function filterBySearch($query, $data)
  {

    $query = parent::filterBySearch($query, $data);
    $query = $this->filterByPrice($query, $data['minPrice'], $data['maxPrice']);

    return $query;
  }


  //public function search($data){
  //  $query = parent::search($data);
  //  $query = $this->filterByPrice($query, $data['minPrice'], $data['maxPrice']);

  // return $query;
  // }

  public function list(ServerRequestInterface $request)
  {
    $data = $this->prepareSearch($request->getQueryParams());
    $products = $this->search($data)->withCount('shops');

    session()->put('bookmark.product-detail', $request->getUri());

    return view('product.list', [
      'products' => $products->paginate(3),
      'data' => $data,
    ]);

  }



  //public function list(ServerRequestInterface $request)
  //{
  // $data = $this->prepareSearch($request->getQueryParams());
  // $products = $this->search($data)->withCount('shops');

  // return view('product.list',[
  //    'products' => $products->paginate(3),
  //    'data' => $data,
  // ]);
  // }

  public function detail($code)
  {
    $product = Product::where('code', $code)->first();

    return view('product.detail', [
      'product' => $product,
    ]);
  }

  public function createForm()
  {
   $categories = Category::orderBy('code')->get();
    return view('product.create', [
      'categories' => $categories,
    ]);
  }

  public function create(ServerRequestInterface $request)
  {
    $data = $request->getParsedBody();
    $product = Product::create($data);

    return redirect()->route('product-list')->with('status',"Product {$product->code} was created.");
  }

  public function showShop(ServerRequestInterface $request, ShopController $shopController, $code)
  {
    $product = Product::where('code', $code)->first();
    $data = $shopController->prepareSearch($request->getQueryParams());
    $query = $shopController->filterBySearch($product->shops(), $data);

    return view('product.shop', [
      'title' => "Product {$product->code} : Shop",
      'product' => $product,
      'data' => $data,
      'shops' => $query->paginate(5),
    ]);
  }

  public function addShopForm(ServerRequestInterface $request, ShopController $shopController, $code)
  {
    $product = $this->find($code);
    $query = Shop::orderBy('code')->whereDoesntHave('products', function ($innerQuery) use ($product) {
      return $innerQuery->where('code', $product->code);
    });
    $data = $shopController->prepareSearch($request->getQueryParams());
    $query = $shopController->filterBySearch($query, $data);

    return view('product.add-shop-form', [
      'title' => "{$this->title} {$product->code} : Add Shop", 'data' => $data,
      'product' => $product,
      'shops' => $query->paginate(5),
    ]);
  }

  function addShop(ServerRequestInterface $request, ShopController $shopController, $code) 
  { 
    $product = $this->find($code); 
    $data = $request->getParsedBody(); 
    $shop = $shopController->find($data['shop']); 
    $product->shops()->attach($shop); 
    return redirect()->route('product-list')->with('status',"Shop {$shop->code} was added to Product {$product->code}.");
    return redirect()->back(); 
    
  } 

  function removeShop($productCode, $shopCode) { 
    $product = $this->find($productCode); 
    $shop = $product->shops() ->where('code', $shopCode)->firstOrFail() ; 
    $product->shops()->detach($shop); 
    return redirect()->route('product-list')->with('status',"Shop {$shop->code} was removed from Product {$product->code}.");
    return redirect()->back(); 
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
                            ->orWhereHas('category',function($query) use ($word){
                                $query->where('name','LIKE',"%{$word}%");
                            });
                            
                });
            }
        }
       return $query;
 }
    
  public function updateForm($code)
  {
    $product = Product::where('code', $code)->first();
    $categories = Category::orderBy('code')->get();

    return view('product.update', [
      'product' => $product,
      'categories' => $categories,
    ]);
  }

  public function update(ServerRequestInterface $request, $code)
  {
    $data = $request->getParsedBody();

    $product = Product::where('code', $code)->first();

    $product->update($data);

    return redirect()->route('product-list')->with('status',"Product {$product->code} was updated.");

    // return redirect()->route('product-detail', ['code' => $product['code']]);
  }

  public function delete($code)
  {
    $product = Product::where('code', $code)->first();

    $product->delete();

    return redirect(session()->get('bookmark.product-detail',route('product-list')))->with('status',"Product {$product->code} was deleted.");
  }
}
