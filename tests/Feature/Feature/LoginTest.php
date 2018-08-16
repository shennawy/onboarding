<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   
    public function testExample()
    {
        $this->assertTrue(true);
    }
    

    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->asserStatus(422)
            ->assertJson([
                'email' => ['The email field is required'],
                'password' => ['The password field is required'],
            ]);
    }

    public function testUserLoginSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('hobhob'),
        ]);

        $payload = ['Email' => 'testlogin@user.com', 'password' => 'hobhob'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                
                ],
            ]);
    }
}
