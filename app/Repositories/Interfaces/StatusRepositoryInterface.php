<?php
namespace App\Repositories\Interfaces;

interface StatusRepositoryInterface {
    public function getAllStatus();
    public function getStatusById($statusId, $userId);
    public function createStatus(array $data);
    public function updateStatus($statusId, array $data);
    public function deleteStatus($statusId, $userId);
}
