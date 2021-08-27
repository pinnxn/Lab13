<?php

namespace App\Http\Controllers;


use App\Models\Category;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ServerRequestInterface;

class CategoryController extends SearchableController
{
    public function getQuery(){
      return Category::orderBy('code');
    }

    public function list(ServerRequestInterface $request)
    {
      $data = $this->prepareSearch($request->getQueryParams());
      $categories = $this->search($data)->withCount('products');

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
      Category::create($data);

      return redirect()->route('category-list');
    }

    public function showProduct(ServerRequestInterface $request, ProductController $productController, $code ){
      $category = Category::where('code',$code)->first();
      $data = $productController->prepareSearch($request->getQueryParams());
      $query = $productController->filterBySearch($category->products(), $data);

      return view('category.product',[
        'title' => "category {$category->code} : Product",
        'category' =>$category,
        'data' => $data,
        'products' => $query->paginate(5),
      ]);
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

     return redirect()->route('category-detail',['code'=> $category['code']]);
    }

    public function delete($code)
    {
      $category = Category::where('code',$code)->first();

      $category->delete();

      return redirect()->route('category-list');
    }
}
