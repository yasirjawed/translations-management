<?php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    protected $model = Translation::class;

    public function definition(): array
    {
        return [
            'locale' => $this->faker->randomElement(['en', 'fr', 'es', 'de']),
            'key' => 'key_' . $this->faker->unique()->uuid,
            'content' => $this->faker->sentence(),
            'tags' => json_encode([$this->faker->randomElement(['mobile', 'desktop', 'web'])]),
        ];
    }
}
