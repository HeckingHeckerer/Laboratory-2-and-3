<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiExceptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_missing_api_resource_returns_safe_json_404(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $this->getJson('/api/v1/students/999999')
            ->assertNotFound()
            ->assertExactJson(['success' => false, 'message' => 'Resource not found.']);
    }
}
