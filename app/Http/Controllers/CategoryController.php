<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ServerRequestInterface;

class CategoryController extends SearchableController
{
  public $title = 'Category';

    public function getQuery(){
      return Category::orderBy('code');
    }

    public function list(ServerRequestInterface $request)
    {
      $data = $this->prepareSearch($request->getQueryParams());
      $categories = $this->search($data)->withCount('products');
      session()->put('bookmark.category-detail', $request->getUri());

        return view('category.list',[
            'categories' => $categories->paginate(5),
            'data'=> $data,
        ]);
    }


    public function detail($code){
      $category = Category::where('code',$code)->first();

      return view('category.detail',[
        'category'=>$category,
      ]);
    }

    public function createForm(){
      return view('category.create');
    }

    public function create(ServerRequestInterface $request)
    {  
      $data = $request->getParsedBody();
      $category = Category::create($data);
      return redirect()->route('category-list')->with('status',"Category {$category->code} was created.");
      // return redirect()->route('category-list');
    }

    public function showProduct(ServerRequestInterface $request, ProductController $productController, $code ){
      $category = Category::where('code',$code)->first();
      $data = $productController->prepareSearch($request->getQueryParams());
      $query = $productController->filterBySearch($category->products(), $data);
      session()->put('bookmark.product.detail', $request->getUri());

      return view('category.product',[
        'title' => "category {$category->code} : Product",
        'category' =>$category,
        'data' => $data,
        'products' => $query->paginate(5),
      ]);
    }

    public function addProductForm(ServerRequestInterface $request,  ProductController $productController, $code)
    {
      $category = $this->find($code);
      $query = Product::orderBy('code')->whereDoesntHave('category', function ($innerQuery) use ($category) {
        return $innerQuery->where('code', $category->code);
      });
      $data =$productController->prepareSearch($request->getQueryParams());
      $query =$productController->filterBySearch($query, $data);
  
      return view('category.add-product-form', [
        'title' => "{$this->title} {$category->code} : Add Category", 'data' => $data,
        'category' => $category,
        'products' => $query->paginate(5),
      ]);
    }
  
    function addProduct(ServerRequestInterface $request,  ProductController $productController, $code) 
    { 
      $category = $this->find($code); 
      $data = $request->getParsedBody(); 
      $product =$productController->find($data['product']); 
      $category->products()->save($product); 
      return redirect()->route('category-list')->with('status',"Product {$product->code} was added to Category {$category->code}.");
      return redirect()->back(); 
    } 


    public function updateForm($code)
    {
       $category = Category::where('code',$code)->first();

       return view('category.update',[
         'category' => $category,
       ]);
    }

    public function update(ServerRequestInterface $request , $code)
    {
     $data = $request->getParsedBody();

     $category = Category::where('code',$code)->first();

     $category->update($data);

     return redirect()->route('category-list')->with('status',"Category {$category->code} was updated.");

     //return redirect()->route('category-detail',['code'=> $category['code']]);
    }

    public function delete($code)
    {
      $category = Category::where('code',$code)->first();

      $category->delete();
      return redirect()->route('category-list')->with('status',"Category {$category->code} was deleted.");

      // return redirect()->route('category-list');
    }
}
