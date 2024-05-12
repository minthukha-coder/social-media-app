<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $request->validate([
            'text' => 'required'
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $postId,
            'text' => $request->text
        ]);

        return back();
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment, $id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'text' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return redirect()->route('posts.show', $comment->post_id)->with('successMsg', 'You have successfully updated to comment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('successMsg', 'You have successfully deleted to comment');
    }
}
