<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\UserService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase {

    protected $userService;
    use RefreshDatabase;

    protected function setUp() : void {  
        parent::setUp();
        $this->userService = new UserService();
    }

    public function testStore() {
        $request = new Request([
            'name' => 'Andrei',
            'email' => 'andrei2001@yahoo.com',
            'password' => 'password2001'
        ]);
        $user = $this->userService->store($request);
        $this->assertDatabaseHas('users', ['name' => 'andrei', 'email' => 'andrei2001@yahoo.com']);
        $this->assertTrue(Hash::check('password2001', $user->password));
    }

    public function testIndex() {
        User::factory()->count(5)->create();
        $users = $this->userService->index();
        $this->assertCount(5, $users);
    }

    public function testShow() {
        $user = User::factory()->create();
        $users = $this->userService->show($user);
        $this->assertEquals($user->id, $users->id);
    }

    public function testUpdate() {
        $user = User::factory()->create();
        $request = new Request([
            'name' => 'Andrei',
            'email' => 'andrei1508@yahoo.com',
            'password' => 'password1508'
        ]);
        $users = $this->userService->update($request, $user);
        $this->assertEquals('Andrei', $users->name);
        $this->assertEquals('andrei1508@yahoo.com', $users->email);
        $this->assertTrue(Hash::check('password1508', $users->password));
    }

    public function testDelete() {
        $user = User::factory()->create();
        $this->userService->destroy($user);
        $this->assertDatabaseMissing('users', ['id'=>$user->id]);
    }
    
}