<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(PostService $postService) {
        $users = $postService->index();
        return response() -> json($users);
    }
    public function store(Request $request, PostService $postService) {
        $post = $postService->store($request);
        return response() -> json($post);

    }
    public function show(Post $post, PostService $postService) {
        $post = $postService -> show($post);
        return response() -> json($post);
    }
    public function update(Request $request, Post $post, PostService $postService) {
        $updatedUser = $postService->update($request, $post);
        return response() ->json($updatedUser);
    }
    public function destroy(Post $post, PostService $postService) {
        $postService->destroy($post);
        return response() ->json(['data' => 'success']);
    }

    public function getUserWithPosts($post, PostService $postService) {
        $post = $postService -> getUserWithPosts($post);
        return response() ->json($post);
    }
    public function filter(PostService $postService, Request $request) {
        $post = $postService -> filter($request);
        return response() ->json($post);
    }
}
