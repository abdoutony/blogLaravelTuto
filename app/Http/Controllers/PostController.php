<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Post;
use App\Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
class PostController extends Controller
{
 
     public function __construct(){
         $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
        $posts = Post::paginate(3);
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $authors = Author::all();
        return view('posts.create',['authors'=>$authors]);
    //      $post = Post::where('id',$id)->with('author')->get();
    //    return view('posts.show',['post'=>$post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $post =new Post();
        // $post->title = $request['title'];
        // $post->content = $request['content'];
        // $post->author_id = $request['author'];
        // $post->save();
        $this->validate($request,[
            'title'=>'required|max:150',
            'content'=>'required|max:5000',
            'author'=>'required',
            'postimage'=>'required|mimes:png,jpg|max:2048'
        ]);

        $fileName = time(). '.' . $request['postimage']->extension();
        $request['postimage']->move(public_path('uploads'),$fileName);

        $post = Post::create([
            'title'=>$request['title'],
            'content'=>$request['content'],
            'postimage'=>'/uploads' . '/' . $fileName, 
            'author_id'=>$request['author'],

        ]);
         
        \Session::flash('success','Successfully created !');
        $posts = Post::paginate(3);

        return Redirect('/posts')->with('posts',$posts);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
      $newcheck = $request['newcheck'];
      $post= Post::where('id',$id)->with('author')->get();
      return view('posts.show',['post'=>$post,'newcheck'=>$newcheck]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id',$id)->with('author')->get();
        $authors = Author::all();
        return view('posts.edit',['post'=>$post,'authors'=>$authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $post=Post::findOrfail($id);
          $this->validate($request,[
            'title'=>'required|max:150',
            'content'=>'required|max:5000',
            'author'=>'required',
        ]);
      
        $post->title=$request['title'];
        $post->content=$request['content'];
        $post->author_id = $request['author'];
        $post->save();
       $post = Post::where('id',$id)->with('author')->get();
        return view('posts.show',['post'=>$post]);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrfail($id);
      $post->delete();
      $posts = Post::all();
      \Session::flash('success','Successfully deleted!');
      return Redirect('/posts')->with('posts',$posts);
      

    }
}
