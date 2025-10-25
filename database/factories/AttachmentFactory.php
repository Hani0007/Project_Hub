<?php

use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'attachment_type' => $this->faker->word(),
            'attachment_format' => $this->faker->fileExtension(),
            'task_id' => \App\Models\Task::factory(),
        ];
    }
}
