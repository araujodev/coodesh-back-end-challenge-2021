<?php

namespace Database\Factories;

use App\Enumerators\UserStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_name' => strtoupper($this->faker->slug(1)),
            'id_value' => $this->faker->uuid,
            'title_name' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => User::FEMALE_GENDER,
            'email' => $this->faker->email(),
            'dob_date' => $this->faker->dateTime(),
            'dob_age' => $this->faker->randomNumber(2),
            'registered_date' => $this->faker->dateTime(),
            'registered_age' => $this->faker->randomNumber(1),
            'phone' => $this->faker->phoneNumber(),
            'cell' => $this->faker->phoneNumber(),
            'nat' => strtoupper($this->faker->slug(1)),
            'large_picture' => $this->faker->imageUrl(),
            'medium_picture' => $this->faker->imageUrl(),
            'thumbnail_picture' => $this->faker->imageUrl(),
            'status' => UserStatusEnum::PUBLISHED,
            'imported_t' => $this->faker->dateTime()
        ];
    }

    /**
     * Status Draft to user.
     *
     * @return Factory
     */
    public function draft(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => UserStatusEnum::DRAFT,
            ];
        });
    }
}
