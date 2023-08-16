<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAll();

        return response()->json(new UserCollection($users));
    }

    public function show(User $user): JsonResponse
    {
        return response()->json(new UserResource($user));
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $request = $request->validated();

        $user = $this->userService->createNew($request);

        return response()->json(new UserResource($user));
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $request = $request->validated();

        try {
            $this->userService->update($request, $user);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ], 422);
        }

        $user->fresh();

        return response()->json(new UserResource($user));
    }

    public function delete(User $user): JsonResponse
    {
        try {
            $user->delete();
        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ], 422);
        }

        return response()->json([
            'result' => "The user has been successfully deleted!"
        ]);
    }
}
