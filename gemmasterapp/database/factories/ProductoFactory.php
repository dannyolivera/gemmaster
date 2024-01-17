<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Obtén una categoría existente o crea una nueva
        $categoria = Categoria::inRandomOrder()->first();

        return [
            'nombre' => $this->faker->word,
            'precio' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'id_categoria' => $categoria->id,
        ];
    }
}
