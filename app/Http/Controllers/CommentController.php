<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Comment;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //print_r($request);die();
        $validated = $request->validated();
        $data = array();
        $data['content']=$request->comment;
        $user = auth()->user();
        if ($user) {
            $userName = $user->name;
            $data['name'] =$userName;
        }
        $postId = $request->post_id;
        $data['post_id'] =$postId;
        $comments_details= Comment::all();

        // insert only requests that already validated in the StoreRequest
        $create = Comment::create($data);
       
        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Comment created successfully!');
             return redirect()->back();
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       // $comments = Comment::all();
        return response()->view('comments.edit', [
            'comment' => Comment::findOrFail($id),
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        $validated = $request->validated();
        $data = array();
        $data['content']=$request->comment;
        $user = auth()->user();
        if ($user) {
            $userName = $user->name;
            $data['name'] =$userName;
        }

        $update = $comment->update($data);

        if($update) {
            session()->flash('notif.success', 'Comment updated successfully!');
            return redirect()->route('posts.home');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $delete = $comment->delete($id);
        if($delete) {
            session()->flash('notif.success', 'Comment deleted successfully!');
            return redirect()->back();
        }

        return abort(500);
    }
}
