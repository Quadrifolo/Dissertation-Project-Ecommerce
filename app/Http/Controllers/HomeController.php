<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Product;

// Models ^ We are using for the system

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
// blocks user if they aren't authenticated 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $user_id = auth()->user()->id;
       // $posts= Post::find($posts);

       $posts = Post::orderBy('created_at','desc')->paginate(0);
        
        return view('home')->with('posts' ,$posts);
    }



    public function compose(View $view)
    {
        $products = session()->get('products.recently_viewed');

        $view->with([
            'recentlyViewed' => Product::find($products),
        ]);

        dd($products);
    }







}


//$posts = Post::orderBy('created_at','desc')->paginate(0);
//return view('posts.index')->with('posts',$posts);