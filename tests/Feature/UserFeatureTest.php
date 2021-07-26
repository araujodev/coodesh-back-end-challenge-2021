<?php

namespace Tests\Feature;

use App\Models\Authorization;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserService $userService
     */
    protected $userService;
    /**
     * @var Authorization $authorization
     */
    protected $authorization;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seedDatabase();
        $this->userService = $this->app->make(UserService::class);
    }

    public function test_update_an_user_by_endpoint(): void
    {
        $newTitleNameString = 'Mrs.';
        $newStatusString = 'trash';

        $response = $this->withHeaders([Authorization::KEY_NAME => $this->authorization->sha1_value])
            ->put('/api/users/' . User::all()->first()->id, [
                'title_name' => $newTitleNameString,
                'status' => $newStatusString,
            ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['user' => ['title_name', 'status']]);

        $responseData = $response->json();

        $this->assertEquals(data_get($responseData, 'user.title_name'), $newTitleNameString);
        $this->assertEquals(data_get($responseData, 'user.status'), $newStatusString);
    }

    public function test_delete_an_user_by_endpoint(): void
    {
        $response = $this->withHeaders([Authorization::KEY_NAME => $this->authorization->sha1_value])
            ->delete('/api/users/' . User::all()->first()->id);

        $response->assertStatus(Response::HTTP_OK);

        $responseData = $response->json();

        $this->assertEquals(true, data_get($responseData, 'user_deleted'));
    }

    public function test_get_one_user_by_endpoint(): void
    {
        $response = $this->withHeaders([Authorization::KEY_NAME => $this->authorization->sha1_value])
            ->get('/api/users/' . User::all()->first()->id);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['user']);
    }

    public function test_list_all_user_by_endpoint(): void
    {
        $response = $this->withHeaders([Authorization::KEY_NAME => $this->authorization->sha1_value])
            ->get('/api/users');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['data']);

        $responseData = $response->json();
        $this->assertNotEmpty(data_get($responseData, 'data'));
    }

    private function seedDatabase(): void
    {
        User::factory()->count(2000)->create();
        $this->authorization = Authorization::factory()->create();
    }

}
