<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\studentsData>
 */
class studentsDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
      

        return [
            'name' => $this->faker->name(),
            'nisn' =>  random_int(10000000, 99999999),
            'school_name' => $this->faker->randomElement(['Institut Teknologi Nasional Bandung', 'Universitas indonesia', 'Universitas Padjadjaran
', 'Institut Teknologi Sepuluh Nopember']),
            'mother_name' => $this->faker->name('female'),
            'birthday' => $this->faker->date()
        ];
    }
}
