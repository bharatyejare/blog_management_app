<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessionId = auth()->id();
       // echo "<pre>";print_r( session());
        $query = "SELECT posts.id,posts.title, posts.content,posts.created_at,posts.updated_at
              FROM posts
              WHERE user_id = :userId";
        $postDetails = DB::select($query, ['userId' => $sessionId]);
        return response()->view('posts.home', [
            'posts'=>$postDetails,
        ]);
        //  $posts = Post::all();
        // return view('posts.home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessionId = session()->getId();
        $categories = Category::all();
        return response()->view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        
        $validated = $request->validated();
        $data = array();
        $data['title']=$request->title;
        $data['content']=$request->content;
        $data['user_id'] =auth()->id();
        $data['category_id'] =$request->category_id;
        // insert only requests that already validated in the StoreRequest
        $create = Post::create($data);
       
        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Post created successfully!');
            return redirect()->route('posts.home');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $categories = Category::all();
        $query = "SELECT comments.id,comments.name, comments.content
              FROM comments
              WHERE post_id = :postId";
       $commentsWithPost = DB::select($query, ['postId' => $id]);
        return response()->view('posts.show', [
            'post' => Post::findOrFail($id),
            'categories' => $categories,
            'postId' => $id,
            'comments_details'=>$commentsWithPost,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        return response()->view('posts.edit', [
            'post' => Post::findOrFail($id),
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validated();
        $data = array();
        $data['title']=$request->title;
        $data['content']=$request->content;
        $data['user_id'] =auth()->id();
        $data['category_id'] =$request->category_id;
        $update = $post->update($data);

        if($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('posts.home');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $delete = $post->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Post deleted successfully!');
            return redirect()->route('posts.home');
        }

        return abort(500);
    }
}
