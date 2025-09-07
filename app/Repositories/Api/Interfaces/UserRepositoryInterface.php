<?php
namespace App\Repositories\Api\Interfaces;

interface UserRepositoryInterface
{
    // Define method signatures for user-related data operations
    public function findbyId(int $id);
    public function update(array $data);
}