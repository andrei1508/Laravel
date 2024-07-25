<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

class PostService {
    public function store(Request $request) {
        // $request->validate([
        //     'name' => 'required | string',
        //     'email' => 'required | email | unique:users,email',
        //     'password' => 'required | string | min:10'
             
        // ]);
        $post = new Post([
            'author_id'=>$request->author_id,
            'title'=>$request->title,
            'posts'=>$request->posts
            
        ]);
        $post->save();
        return $post;
    }

    public function index() {
        $users = Post::all();
        return $users;
    }

    public function show(Post $post) {
        return $post;

    }

    public function update(Request $request, Post $post) {
        $request->validate([
            'author_id' => 'required | string',
            'title' => 'required | title | unique:posts,title,' .$post->id,
            'posts' => 'nullable | string | min:10'
        ]);
        $post->author_id = $request->author_id;
        $post->title = $request->title;
        $post->posts = $request->posts;
        
        $post->save();
        return $post;
    }

    public function destroy(Post $post) {
        $post->delete();
    }

    public function getUserWithPosts(int $post) {
        $result = Post::where('id', $post)
                        ->with('posts')
                        ->get();

        return $result;                
    }
    
    public function filter($request) {
        $result = null;
        if($request->has('title')) {
            $result = Post::where('title', $request->get('title'))
                            ->get();
        }
        return $result;
    } 
}



