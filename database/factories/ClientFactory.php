<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Client::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'cpf'  => $this->faker->randomElement(['000.000.000-00', '111.111.111-111', '222.222.222-22']),
            'data' => $this->faker->date,
            'sex' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'address' => $this->faker->address,
            'state' => $this->faker->randomElement(['SP']),
            'city' => $this->faker->randomElement(['São Paulo', 'Ribeirão Preto', 'Guarulhos']),
            'UF' => 'SP',
        ];
    }
}
