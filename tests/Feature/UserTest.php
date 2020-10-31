<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * Test to verify proper validation is 
     * taking place.
     * 
     * should return code: 400
     * @return void
     */
    public function testRegisterUserValidation() {

        $payload = [
            'name' => "Mak",
            'password' => "pas",
            'role' => "super-bawa"
        ];

        $response = $this->json('POST', 'api/register', $payload);
         $response
            ->assertStatus(400);
    }


    /**
     * Test to verify proper validation is 
     * taking place.
     * 
     * should return code: 401 (user already exists)
     * @return void
     */
    public function testRegisterUserCreation() {

        $payload = [
            'name' => "Admin",
            'password' => "admin",
            'role' => "super-bawa"
        ];

        $response = $this->json('POST', 'api/register', $payload);
        $response->dump();
        $response->assertStatus(401);
    }




    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
