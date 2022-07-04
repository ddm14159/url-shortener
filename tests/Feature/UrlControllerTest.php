<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Url;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    use RefreshDatabase;

    private Url $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = Url::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testStoreNew()
    {
        $full = fake()->url();
        $this->post('/', ['url' => $full]);
        $this->assertDatabaseHas('urls', compact('full'));
    }

    public function testStoreOld()
    {
        $shortened = $this->url->shortened;
        $full = $this->url->full;
        $response = $this->post('/', ['url' => $full]);
        $response->assertSee($shortened);
    }

    public function testRedirect404()
    {
        $response = $this->get('/aa');
        $response->assertStatus(404);
        $response = $this->get('/aabbcc');
        $response->assertStatus(404);
    }

    public function testRedirect()
    {
        $shortened = $this->url->shortened;
        $full = $this->url->full;
        $response = $this->get($shortened);
        $response->assertRedirect($full);
    }
}
