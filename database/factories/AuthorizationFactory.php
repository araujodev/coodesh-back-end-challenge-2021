<?php

namespace Database\Factories;

use App\Enumerators\AuthorizationStatusEnum;
use App\Models\Authorization;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorizationFactory extends Factory
{
    /**
     * @var string $model
     */
    protected $model = Authorization::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'key' => Authorization::KEY_NAME,
            'sha1_value' => $this->faker->sha1(),
            'status' => AuthorizationStatusEnum::ACTIVE
        ];
    }

    /**
     * With Inactive Status.
     *
     * @return Factory
     */
    public function inactive(): Factory
    {
        return $this->state(function (array $attributes) {
            return ['status' => AuthorizationStatusEnum::INACTIVE ];
        });
    }
}
