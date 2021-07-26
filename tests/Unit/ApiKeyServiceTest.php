<?php

namespace Tests\Unit;

use App\Models\Authorization;
use App\Services\ApiKeyService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiKeyServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var ApiKeyService $apiKeyService
     */
    protected $apiKeyService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->apiKeyService = $this->app->make(ApiKeyService::class);
    }

    public function test_generate_valid_authorization_key_with_client(): void
    {
        /**
         * @var ?Authorization $authorization
         */
        $authorization = $this->apiKeyService->generate('defaultClient');

        $this->assertNotEmpty($authorization);
        $this->assertDatabaseCount(Authorization::class, 1);
        $this->assertDatabaseHas(Authorization::class, [
            'sha1_value' => $authorization->sha1_value,
            'key' => Authorization::KEY_NAME
        ]);
    }

    public function test_generate_valid_authorization_key_without_client(): void
    {
        /**
         * @var ?Authorization $authorization
         */
        $authorization = $this->apiKeyService->generate();

        $this->assertNotEmpty($authorization);
        $this->assertDatabaseCount(Authorization::class, 1);
        $this->assertDatabaseHas(Authorization::class, [
            'sha1_value' => $authorization->sha1_value,
            'key' => Authorization::KEY_NAME
        ]);
    }

    public function test_get_one_by_sha1_value_valid(): void
    {
        /**
         * @var Authorization $generated
         */
        $generated = Authorization::factory()->create();

        $founded = $this->apiKeyService->getOneByValue($generated->sha1_value);

        $this->assertNotEmpty($founded);
    }

    public function test_get_one_by_sha1_value_invalid(): void
    {
        $invalidValue = sha1('test');
        $registry = $this->apiKeyService->getOneByValue($invalidValue);

        $this->assertEmpty($registry);
    }

    public function test_compare_valid_key(): void
    {
        /**
         * @var ?Authorization $authorization
         */
        $authorization = $this->apiKeyService->generate();

        $compareResult = $this->apiKeyService
            ->compareIsValidKey($authorization->sha1_value);

        $this->assertTrue($compareResult);
    }

    public function test_compare_invalid_status(): void
    {
        /**
         * @var Authorization $generated
         */
        $inactiveKey = Authorization::factory()
            ->state(['status' => 'inactive'])
            ->create();

        $compareResult = $this->apiKeyService
            ->compareIsValidKey($inactiveKey->sha1_value);

        $this->assertFalse($compareResult);
    }



}
