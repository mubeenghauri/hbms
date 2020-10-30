<?php

namespace Tests\Feature;

// use log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Account;

class AccountTest extends TestCase
{

    public function testAccquireToken() 
    {
        $payload = [
            "name" => "Admin",
            "password" => "admin"
        ];

        $response = $this->json('POST', 'api/login', $payload);
        $response->dump();
        $token = json_decode($response->getContent());
        $token = (array)$token;
        $token = $token['token'];
        echo $token;
        $this->assertTrue(true);
        return $token;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateAccount()
    {
        $payload = [
            'name' => "Test Account9",
            'owner' => "admin",
            'description' => "some desc",
            'created_on' => "23-08-2011",
            'token' => $this->testAccquireToken()
        ];
        $response = $this->json('POST', 'api/accounts', $payload);
        // log::info((array)$response); 
        // print_r($response);
        $response->dump();
        $response
            ->assertStatus(403)
            ->assertJson([
                'error' => "User already exists"
            ]);
    }

    public function testAccountCreated() {
        $this->assertTrue(Account::accountExists("Test Account2"));
    }
}
