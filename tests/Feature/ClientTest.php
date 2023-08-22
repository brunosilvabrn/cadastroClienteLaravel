<?php

namespace Tests\Feature;

use App\Models\Client;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    private Generator $faker;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->faker = Factory::create();
    }

    public function test_index_return_data_valid_format_products()
    {
        $this->json('get', '/api/clients')
            ->assertStatus(200)
            ->assertJsonStructure(
                [

                    '*' => [
                        "id",
                        "name",
                        "cpf",
                        "data",
                        "sex",
                        "address",
                        "state",
                        "UF",
                        "city",
                    ]

                ]
            );
    }

    public function test_making_an_creat_request(): void
    {

        $data = [
            'name' => $this->faker->word,
            'cpf'  => $this->faker->randomElement(['000.000.000-00', '111.111.111-111', '222.222.222-22']),
            'data' => $this->faker->date,
            'sex' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'address' => $this->faker->address,
            'state' => $this->faker->randomElement(['SP']),
            'city' => $this->faker->randomElement(['São Paulo', 'Ribeirão Preto', 'Guarulhos']),
            'UF' => 'SP',
        ];

        $response = $this->postJson('/api/client', $data);

        $response->assertStatus(201)
            ->assertJson($data);
    }

    public function test_product_is_destroyed()
    {
        $productData = [
            'name' => $this->faker->word,
            'cpf'  => $this->faker->randomElement(['000.000.000-00', '111.111.111-111', '222.222.222-22']),
            'data' => $this->faker->date,
            'sex' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'address' => $this->faker->address,
            'state' => $this->faker->randomElement(['SP']),
            'city' => $this->faker->randomElement(['São Paulo', 'Ribeirão Preto', 'Guarulhos']),
            'UF' => 'SP',
        ];

        $product = Client::create($productData);

        $this->json('delete', "/api/client/$product->id")
            ->assertStatus(201);
    }

    public function test_update_product_returns_correct_data() {

        $product = Client::create(
            [
                'name' => $this->faker->word,
                'cpf'  => $this->faker->randomElement(['000.000.000-00', '111.111.111-111', '222.222.222-22']),
                'data' => $this->faker->date,
                'sex' => $this->faker->randomElement(['Masculino', 'Feminino']),
                'address' => $this->faker->address,
                'state' => $this->faker->randomElement(['SP']),
                'city' => $this->faker->randomElement(['São Paulo', 'Ribeirão Preto', 'Guarulhos']),
                'UF' => 'SP',
            ]
        );


        $payload = [
            'name' => $this->faker->word,
            'cpf'  => $this->faker->randomElement(['000.000.000-00', '111.111.111-111', '222.222.222-22']),
            'data' => $this->faker->date,
            'sex' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'address' => $this->faker->address,
            'state' => $this->faker->randomElement(['SP']),
            'city' => $this->faker->randomElement(['São Paulo', 'Ribeirão Preto', 'Guarulhos']),
            'UF' => 'SP',
        ];

        $this->json('put', "/api/client/$product->id", $payload)
            ->assertStatus(200);
    }
}
