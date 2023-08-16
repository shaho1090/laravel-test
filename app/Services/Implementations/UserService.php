<?php

namespace App\Services\Implementations;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function __construct(private User $userModel)
    {
    }

    /**
     * @param int $pagination
     */
    public function getAll(int $pagination = 15)
    {
        return $this->userModel->paginate($pagination);
    }

    /**
     * @param array $request
     * @return Model
     */
    public function createNew(array $request): Model
    {
        $request['password'] = Hash::make($request['password']);

        return $this->userModel->create($request);
    }

    public function update(array $request, User $user): bool
    {
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        return $user->update($request);
    }
}
