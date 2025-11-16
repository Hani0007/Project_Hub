<?php

namespace App\Repositories\Interfaces;

interface ProjectRepositoryInterface
{
    public function allByUser($userId);
    public function findByIdAndUser($id, $userId);
    public function create(array $data);
    public function update($id, array $data, $userId);
    public function delete($id, $userId);
}
