<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        Post::create($data);
        return redirect()->route('home')->with('successMsg', 'A post has been successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        return view('post.detail', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $postId = $post->id;
        if ($postId) {
            $post = Post::findOrFail($postId);
        }

        $posts = Post::latest()->get();

        return view('welcome', compact('post', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $data = $this->validateRequest($request);
        $post->update($data);
        return redirect()->route('home')->with('successMsg', 'A post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home')->with('successMsg', 'A post has been deleted successfully');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            "user_id" => "required",
            "title" => "required",
            "body" => "required",
        ]);
    }
}
