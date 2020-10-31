<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntryTest extends TestCase
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
        // echo $token;
        $this->assertTrue(true);
        return $token;
    }

    /**
      * A basic feature test example.
      *
      * @return void
      */
    public function testPostEntry()
    {
        $payload = [
            "token" => $this->testAccquireToken(),
            "to"    => "hassaan",
            "description" => "Test9",
            "amount"      => 3000,
            "made_on"     => "31-10-2020"
        ];
        $response = $this->json("POST", 'api/accounts/Test9/d/entry/test', $payload);
        $response->dump();
        $response->assertStatus(200);
    }
}
