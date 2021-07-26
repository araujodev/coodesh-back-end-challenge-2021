<?php

namespace Tests\Unit;

use App\Enumerators\UserStatusEnum;
use App\Exceptions\BuildExceptions;
use App\Exceptions\UserExceptions;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserService $userService
     */
    protected $userService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    /**
     * @throws BuildExceptions
     */
    public function test_update_valid_user(): void
    {
        User::factory()->count(1)->create();

        /**
         * @var User $user
         */
        $user = User::all()->first();

        $this->userService->update($user->id,
        [
            'gender' => User::MALE_GENDER,
            'status' => UserStatusEnum::TRASH,
            'title_name' => 'Mrs.'
        ]);

        $oldGender = $user->gender;
        $oldStatus = $user->status;
        $oldTitleName = $user->title_name;

        $user->refresh();

        $this->assertNotEquals($oldGender, $user->gender);
        $this->assertNotEquals($oldStatus, $user->status);
        $this->assertNotEquals($oldTitleName, $user->title_name);
    }

    public function test_remove_valid_user(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $deleted = $this->userService->remove($user->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseCount(User::class, 0);
    }

    public function test_remove_invalid_user(): void
    {
        User::factory()->create();
        $deleted = $this->userService->remove(rand(1,100));

        $this->assertFalse($deleted);
        $this->assertDatabaseCount(User::class, 1);
    }

    /**
     * @throws BuildExceptions
     */
    public function test_get_one_valid_user(): void
    {
        /**
         * @var User $user
         */
        $user = User::factory()->create();
        $foundedUser = $this->userService->getOne($user->id);

        $this->assertInstanceOf(User::class, $foundedUser);
        $this->assertNotEmpty($user);
    }

    /**
     * @throws BuildExceptions
     */
    public function test_get_one_invalid_user(): void
    {
        $this->expectException(BuildExceptions::class);
        $this->expectExceptionMessage(trans('user_exceptions.' . UserExceptions::NOT_FOUND));

        User::factory()->create();
        $user = $this->userService->getOne(rand(1,100));

        $this->assertEmpty($user);
    }

    public function test_get_paginate_valid_user(): void
    {
        User::factory()->count(200)->create();
        $list = $this->userService->getPaginate();

        $this->assertInstanceOf(LengthAwarePaginator::class, $list);
        $this->assertNotEmpty($list->items());
    }

}
