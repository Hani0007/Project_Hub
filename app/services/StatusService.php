<?php
namespace App\Services;

use App\Repositories\Interfaces\StatusRepositoryInterface;

class StatusService {

    protected $repo;

    public function __construct(StatusRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function getAll() {
        return $this->repo->getAllStatus();
    }

    public function getById($statusId, $userId) {
        return $this->repo->getStatusById($statusId, $userId);
    }

    public function create(array $data) {
        return $this->repo->createStatus($data);
    }

    public function update($statusId, array $data) {
        return $this->repo->updateStatus($statusId, $data);
    }

    public function delete($statusId, $userId) {
        return $this->repo->deleteStatus($statusId, $userId);
    }
}
