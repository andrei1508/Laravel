<?php

namespace App\Services;
use App\Models\Comment
use Illuminate\Http\Request;

class CommentService {

    public function store(Request $request) {
        $comment = new Comment([
            'author_id'=>$request->author_id,
            'post'=>$request->post,
            'comments'=>$request->comment
        ]);
        $comment->save();
        return $comment;
    }

    public function index() {
        $users = Comment::all();
        return $users;
    }

    public function show(Comment $comment) {
        return $comment;
    }

    public function update(Request $request, Comment $comment) {
        $request->validate([
            'author_id' => 'required | string',
            'post' => 'required | string',
            'comments' => 'nullable | string | min:10'
        ]);
        $comment->author_id = $request->author_id;
        $comment->post = $request->post;
        $comment->comments = $request->comments;
        
        $comment->save();
        return $comment;
    }

    public function destroy(Comment $comment) {
        $comment->delete();
    }

    public function getUserWithComments(int $comment) {
        $result = Comment::where('id', $comment)
                        ->with('comments')
                        ->get();

        return $result;                
    }

}
