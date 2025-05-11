<?php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Translation::class;
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->slug,
            'locale' => $this->faker->randomElement(['en', 'fr', 'es']),
            'value' => $this->faker->sentence,
            'tags' => [$this->faker->randomElement(['mobile', 'web', 'desktop'])],
        ];
    }

}
