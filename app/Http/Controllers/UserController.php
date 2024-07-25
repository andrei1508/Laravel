<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(UserService $userService) {
        $users = $userService->index();
        return response() -> json($users);
    }
    public function store(Request $request, UserService $userService) {
        $user = $userService->store($request);
        return response() -> json($user);

    }
    public function show(User $user, UserService $userService) {
        $user = $userService -> show($user);
        return response() -> json($user);
    }
    public function update(Request $request, User $user, UserService $userService) {
        $updatedUser = $userService->update($request, $user);
        return response() ->json($updatedUser);
    }
    public function destroy(User $user, UserService $userService) {
        $userService->destroy($user);
        return response() ->json(['data' => 'success']);
    }

    public function getUserWithPosts($user, UserService $userService) {
        $user = $userService -> getUserWithPosts($user);
        return response() ->json($user);
    }

    public function viewIndex(UserService $userService) {
        $users = $userService->index();
        return view('users.index', compact('users'));
    }

    public function viewShow(User $user, UserService $userService) {
        $user = $userService -> show($user);
        return view('users.show', compact('user'));
    }

    public function viewStore(Request $request, UserService $userService) {
        $user = $userService->store($request);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

}
