<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'task_name'=>$this->faker->sentence(2),
            'task_description'=>$this->faker->paragraph(),
            'project_id'=>\App\Models\Project::factory(),
            'status_id'=>\App\Models\Statuses::factory(),

        ];
    }
}
