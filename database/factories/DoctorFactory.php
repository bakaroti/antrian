<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $nomor = 2;
    public function definition(): array
    {
        return [
            //
            'poly_id' => /*rand(1, 7)*/ $this->nomor - 1,
            'user_id' => $this->nomor++,
        ];
    }
}
