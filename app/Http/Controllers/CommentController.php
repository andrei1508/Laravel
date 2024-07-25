<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(CommentService $commentService) {
        $users = $commentService->index();
        return response() -> json($users);
    }
    public function store(Request $request, CommentService $commentService) {
        $comment = $commentService->store($request);
        return response() -> json($comment);

    }
    public function show(Post $comment, CommentService $commentService) {
        $comment = $commentService -> show($comment);
        return response() -> json($comment);
    }
    public function update(Request $request, Post $comment, CommentService $commentService) {
        $updatedUser = $commentService->update($request, $comment);
        return response() ->json($updatedUser);
    }
    public function destroy(Post $comment, CommentService $commentService) {
        $commentService->destroy($comment);
        return response() ->json(['data' => 'success']);
    }

    public function getUserWithComments($comment, CommentService $commentService) {
        $comment = $commentService -> getUserWithPosts($comment);
        return response() ->json($comment);
    }
    public function filter(CommentService $commentService, Request $request) {
        $comment = $commentService -> filter($request);
        return response() ->json($comment);
    }
}