<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function allByUser($userId)
    {
        return Project::where('user_id', $userId)->with('user')->get();
    }

    public function findByIdAndUser($id, $userId)
    {
        return Project::where('id', $id)->where('user_id', $userId)->first();
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update($id, array $data, $userId)
    {
        $project = $this->findByIdAndUser($id, $userId);
        if ($project) {
            $project->update($data);
            return $project;
        }
        return null;
    }

    public function delete($id, $userId)
    {
        $project = $this->findByIdAndUser($id, $userId);
        if ($project) {
            $project->delete();
            return true;
        }
        return false;
    }
}
