<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class BeerControllerTest extends TestCase
{
    
    private $route='/api/v1/beers';
    private $headers=['Accept' => 'application/json'];
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthorized()
    {
      
        $response = $this->withHeaders($this->headers)->get($this->route);
        $response->assertUnauthorized();
        
    }

    


    public function test_authorized()
    {
       
        Sanctum::actingAs(User::where('name','root')->first());
        $response = $this->withHeaders($this->headers)->get($this->route);
        $response->assertStatus(200);
    }

    public function test_responseStructure()
    {
       
        Sanctum::actingAs(User::where('name','root')->first());
        $response = $this->withHeaders($this->headers)->get($this->route);
        $response->assertJsonStructure(['status','statusCode','data']);
    }



}
