<?php
namespace App\Repositories;

use App\Models\Statuses;
use App\Repositories\Interfaces\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface {

    public function getAllStatus() {
        return Statuses::all();
    }

    public function getStatusById($statusId, $userId) {
        return Statuses::where('id', $statusId)
                       ->where('user_id', $userId)
                       ->first();
    }

    public function createStatus(array $data) {
        return Statuses::create($data);
    }

    public function updateStatus($statusId, array $data) {
        $status = Statuses::find($statusId);
        if (!$status) return null;

        $status->update($data);
        return $status;
    }

    public function deleteStatus($statusId, $userId) {
        return Statuses::where('id', $statusId)
                       ->where('user_id', $userId)
                       ->delete();
    }
}
