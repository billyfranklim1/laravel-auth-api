<?php

namespace Database\Factories\Webclin;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Webclin\Size>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $number = new Number();

        return [
            'description' => Str::random(10) . '_' . time(),
            'time' => date('H:i:s', $number->randomFloat(0, 0, 86399))
        ];
    }
}
