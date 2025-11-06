<?php
namespace App\Repositories\Interfaces;
interface ProjectRepositoryInterface{
 public function allByUserId(int $userId);
 public function findByIdForUser(int $id, int $userId);
 public function create(array $data);
 public function update(int $id,array $data);
 public function delete(int $id);


}