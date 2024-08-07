<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_see_home_page(): void
    {
        $response = $this->get(route("index"));

        $response->assertStatus(200);
        $response->assertViewIs("index");
    }

    public function test_can_see_courses_home_page(): void
    {
        $response = $this->get(route("index"));

        $response->assertStatus(200);
        $response->assertViewHas("courses", Course::limit(9)->get());
    }
}
