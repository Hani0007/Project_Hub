<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;

/**
 * @extends Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'comment_text' => $this->faker->sentence(),
            'user_id' => \App\Models\User::factory(),
            'project_id' => \App\Models\Task::factory(), // use task_id instead of project_id
        ];
    }
}
