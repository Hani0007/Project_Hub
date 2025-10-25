<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Statuses;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create some statuses first
        $statuses = Statuses::factory()->count(3)->create();

        // Create users, projects, comments, and tasks
        User::factory(5)->create()->each(function ($user) use ($statuses) {
            $projects = Project::factory(2)->create();

            foreach ($projects as $project) {
                // Create comments for each project
                Comment::factory(2)->create([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                ]);

                // Create tasks for each project
                Task::factory(3)->create([
                    'project_id' => $project->id,
                    'status_id' => $statuses->random()->id,
                ]);
            }
        });
    }
}
