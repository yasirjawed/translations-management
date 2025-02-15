<?php

namespace Tests\Feature;

use App\Models\Translation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $headers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->headers = ['Authorization' => 'Bearer ' . $this->user->createToken('api-token')->plainTextToken];
    }

    /** @test */
    public function it_can_create_a_translation()
    {
        $data = [
            'locale' => 'en',
            'key' => 'welcome_message',
            'content' => 'Welcome!',
            'tags' => ['web']
        ];

        $response = $this->postJson('/api/translations', $data, $this->headers);
        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_fetch_translations()
    {
        Translation::factory(10)->create();
        $response = $this->getJson('/api/translations', $this->headers);
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_can_update_a_translation()
    {
        $translation = Translation::factory()->create();
        $data = ['content' => 'Updated Content'];

        $response = $this->putJson("/api/translations/{$translation->id}", $data, $this->headers);
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_export_translations()
    {
        Translation::factory(1000)->create();
        $response = $this->getJson('/api/translations/export', $this->headers);
        $response->assertStatus(200);
    }
}
