<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth' , ['except' => ['index','show']]);
    }



    public function index()
    {
    
        $posts = DB::table('posts')->where('locale', '=', 'EN')->get();

    



        //$posts = Post::orderBy('created_at','desc')->paginate(0);
        return view('posts.index')->with('posts',$posts); //
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
    //    return view('posts.create');
        //
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,  [ 
            'title' => 'required',
            'body' => 'required',
            'cover image' => 'image |nullable|max:1999'
           ]);


           //Handle File Upload

           if($request->HasFile('cover_image')) {
                        //Get Filename with the extension
                        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                        //Get Just Filename
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        // Get Just Ext
                        $extension = $request->file('cover_image')->getClientOriginalExtension();
                        //Filename to Store
                        $fileNameToStore = $filename.'_'.time().'.'.$extension;
                        //Upload Image
                        $path= $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
           } else {
               $fileNameToStore = 'noimage.jpg';

           }

           
       //Create New Post

       $posts =new Post;
       $posts->title =$request->input('title');
       $posts->body  =$request->input('body');
       $posts->user_id = auth()->user()->id;
       $posts->cover_image =$fileNameToStore;
       $posts->save();

       return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
     public function show($id)
    {
        $posts = Post::find($id);


       return view('posts.show')->with('posts', $posts);
    
     


        //returns id from the database using eliquen 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $posts = Post::find($id);

        //checks for correct user
        if(auth()->user()->id !==$posts->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        

        return view('posts.edit')->with('posts',$posts);
       
    }



    
  public function search(Request $request) {


    $query = $request->input('query');

    $posts = DB::table('posts')
    ->where('title', 'LIKE',"%$query%")
    ->orWhere('jp_title', 'LIKE', "%$query%")
    ->orWhere('ng_title', 'LIKE',"%$query%" )
    ->get();
    
        return view('posts.index' , ['posts' => $posts]);

  }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // public function update(Request $request, $id)
    //{
      //  $this->validate($request, [
  //          'title' => 'required',
           // 'body' => 'required'
       // ]);
		//$post = Post::find($id);
         // Handle File Upload
        //if($request->hasFile('cover_image')){
            // Get filename with the extension
          //  $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
           // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
          //  $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
          //  $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
         //   $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            // Delete file if exists
           // Storage::delete('public/cover_images/'.$post->cover_image);
       // }

        // Update Post
     //   $post->title = $request->input('title');
      //  $post->body = $request->input('body');
     //   if($request->hasFile('cover_image')){
      //      $post->cover_image = $fileNameToStore;
      //  }
     //   $post->save();

     //   return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
   # {
    /*    $posts = Post::find($id);

        //checks for correct user
        if(auth()->user()->id !==$posts->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');

        }

        If($posts->cover_image != 'noimage.jpg'){

            Storage:: delete('public/cover_images/' .$posts->cover_image);
        }

        
        $posts->delete();
        return redirect('/posts')->with('success', 'Post Removed');



        //
    }
*/

