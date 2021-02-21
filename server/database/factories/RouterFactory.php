<?php

namespace Database\Factories;

use App\Models\Router;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Router::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sap_id'        => $this->faker->unique()->numberBetween($min = 1000, $max = 1000000000),
            'hostname'      => $this->faker->unique()->domainName,
            'loopback'      => $this->faker->unique()->ipv4,
            'mac_address'   => $this->faker->unique()->macAddress,
        ];
    }
}
