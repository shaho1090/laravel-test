<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserServiceInterface
{

    /**
     * @param int $pagination
     */
    public function getAll(int $pagination = 15);

    /**
     * @param mixed $request
     * @return ?Model
     */
    public function createNew(array $request): ?Model;

    /**
     * @param array $request
     * @param User $user
     */
    public function update(array $request, User $user);
}
