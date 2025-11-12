<?php

namespace App\Services;

use App\Repositories\Interfaces\ProjectRepositoryInterface;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllProjects($userId)
    {
        return $this->projectRepository->allByUser($userId);
    }

    public function getProject($id, $userId)
    {
        return $this->projectRepository->findByIdAndUser($id, $userId);
    }

    public function createProject(array $data)
    {
        return $this->projectRepository->create($data);
    }

    public function updateProject($id, array $data, $userId)
    {
        return $this->projectRepository->update($id, $data, $userId);
    }

    public function deleteProject($id, $userId)
    {
        return $this->projectRepository->delete($id, $userId);
    }
}
