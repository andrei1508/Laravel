<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService {
    public function store(Request $request) {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | string | min:10'
             
        ]);
        $user = new User([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
            
        ]);
        $user->save();
        return $user;
    }

    public function index() {
        $users = User::all();
        return $users;
    }

    public function show(User $user) {
        return $user;

    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required | string',
            'email' => 'required | email | unique:users,email,' .$user->id,
            'password' => 'nullable | string | min:10'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return $user;
    }

    public function destroy(User $user) {
        $user->delete();
    }

    public function getUserWithPosts(int $user) {
        $result = User::where('id', $user)
                        ->with('posts')
                        ->get();

        return $result;                
    }
    

}


