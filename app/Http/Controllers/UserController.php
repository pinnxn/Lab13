<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Database\QueryException;

class UserController extends SearchableController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public $title = 'User';

    public function getQuery()
    {
      return  User::orderBy('email');
    }
  


    public function list(ServerRequestInterface $request)
  {
    $data = $this->prepareSearch($request->getQueryParams());
    $users = $this->search($data);

    session()->put('bookmark.user-detail', $request->getUri());

    return view('user.list', [
      'users' => $users->paginate(3),
      'data' => $data,
    ]);

  }


  public function detail($email)
  {
    $user = User::where('email', $email)->first();

    return view('user.detail', [
      'user' => $user,
    ]);
  }

  public function createForm()
  {
    $this->authorize('create', User::class);
   $roles = ['ADMIN' , 'USER'];
    return view('user.create', [
      'roles' => $roles,
    ]);
    
  }

  public function create(ServerRequestInterface $request)
  {
    $this->authorize('create', User::class); 
   try{
    $data = $request->getParsedBody();
    $user = new User();
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user-> role = $data['role'];
    $user->password = Hash::make($data['password']); 
    $user->save();

    return redirect()->route('user-list')->with('status',"User {$user->email} was created.");

   }catch (QueryException $excp) {
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
                            ->orWhere('role','LIKE',"%{$word}%");
                });
            }
        }
       return $query;

       
 }
    
  public function updateForm($email)
  {
    $this->authorize('update', User::class); 

    $user = User::where('email', $email)->first();
    $roles = ['ADMIN' , 'USER'];

    return view('user.update', [
      'user' => $user,
      'roles' => $roles,
    ]);
    
  }

  public function update(ServerRequestInterface $request, $email)
  {
    $this->authorize('update', user::class); 

    try{
      $data = $request->getParsedBody();
    

    $user = user::where('email', $email)->first();

    $user->name = $data['name'];
    $user->email = $data['email'];
    $user-> role = $data['role'];
    if(!empty($data['password'])){
    $user->password = Hash::make($data['password']); 
    }
    $user->save();


    return redirect()->route('user-list')->with('status',"User {$user->email} was updated.");
     }catch (QueryException $excp) {
       return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
       ]);
     }
     

  }

  public function delete($email)
  {
    $this->authorize('delete', user::class);
    
    try{
      $user = user::where('email', $email)->first();

    $user->delete();

    return redirect(session()->get('bookmark.user-detail',route('user-list')))->with('status',"User {$user->code} was deleted.");

    }catch (QueryException $excp) {
      return redirect()->back()->withInput()->withErrors(['error' => $excp->errorInfo[2],
      ]);
    }
    
  }
}
