<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Database\QueryException;

class CategoryController extends SearchableController
{
  public $title = 'Category';


    public function __construct(){ 
      $this->middleware('auth'); 
    }
    
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
      $this->authorize('update', Category::class); 
      return view('category.create');
    }

    public function create(ServerRequestInterface $request)
    {  
      $this->authorize('update', Category::class); 
     try{
      $data = $request->getParsedBody();
      $category = Category::create($data);
      return redirect()->route('category-list')->with('status',"Category {$category->code} was created.");
     }catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }
      // return redirect()->route('category-list');
    }

    public function showProduct(ServerRequestInterface $request, ProductController $productController, $code ){
      $this->authorize('update', Category::class); 
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
      $this->authorize('update', Category::class); 
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
     try{
      $category = $this->find($code); 
      $data = $request->getParsedBody(); 
      $product =$productController->find($data['product']); 
      $category->products()->save($product); 
      return redirect()->route('category-list')->with('status',"Product {$product->code} was added to Category {$category->code}.");
      return redirect()->back(); 
     }catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }
    } 


    public function updateForm($code)
    {
      $this->authorize('update', Category::class); 
       $category = Category::where('code',$code)->first();

       return view('category.update',[
         'category' => $category,
       ]);
    }

    public function update(ServerRequestInterface $request , $code)
    {
      $this->authorize('update', Category::class); 
    try{
      $data = $request->getParsedBody();

      $category = Category::where('code',$code)->first();
 
      $category->update($data);
 
      return redirect()->route('category-list')->with('status',"Category {$category->code} was updated.");
    }catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }

     //return redirect()->route('category-detail',['code'=> $category['code']]);
    }

    public function delete($code)
    {
     try{
      $category = Category::where('code',$code)->first();
      $this->authorize('delete', $category); 

      $category->delete();
      return redirect()->route('category-list')->with('status',"Category {$category->code} was deleted.");
     }catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }

      // return redirect()->route('category-list');
    }
}
