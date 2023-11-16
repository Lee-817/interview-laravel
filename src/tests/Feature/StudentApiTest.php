<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    /**
     * static subject name list
     *
     * @var array<mixed>
     */
    public $testerHeader;

    public function setUp(): void
    {
        parent::setUp();
        $tester = User::factory()->create(['email' => 'user@test.com']);
        $token = $tester->createToken('API TOKEN')->plainTextToken;
        $this->testerHeader = ['Authorization' => "Bearer $token"];

        // Run the DatabaseSeeder
        $this->seed();
    }

    public function testGetStudentListing(): void
    {
        $response = $this->withHeaders($this->testerHeader)->getJson('/api/students');

        $response
            ->assertOk()
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->has('status')
                    ->has('data.0', function ($student) {
                        $student->whereAllType([
                            'id' => 'integer',
                            'name' => 'string',
                            'email' => 'string',
                            'created_at' => 'string',
                            'updated_at' => 'string',
                            'courses' => 'array',
                        ]);
                    });
            });
    }

    public function testFilterWithStudentEmail(): void
    {
        Student::factory()->create(['name' => 'bob', 'email' => 'bob@dummy.com']);

        $response = $this->withHeaders($this->testerHeader)->getJson('/api/students?email=bob@dummy.com');

        $response
            ->assertOk()
            ->assertJson(function (AssertableJson $json) {
                $json
                    ->has('status')
                    ->has('data.0', function ($student) {
                        $student
                            ->where('name', 'bob')
                            ->where('email', 'bob@dummy.com')
                            ->etc();
                    });
            });
    }
}
