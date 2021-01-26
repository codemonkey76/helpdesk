<?php

namespace Database\Factories;

use App\Models\TicketEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketEntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TicketEntry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph
        ];
    }
}
