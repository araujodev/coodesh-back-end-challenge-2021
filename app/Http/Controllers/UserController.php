<?php

namespace App\Http\Controllers;

use App\Exceptions\BuildExceptions;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserCollection;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserService $userService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws BuildExceptions
     */
    public function update(int $userId, UserFormRequest $request): JsonResponse
    {
        $user = $this->userService->update($userId, $request->validated());
        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    public function remove(int $userId): JsonResponse
    {
        return response()->json(['user_deleted' => $this->userService->remove($userId)]);
    }

    /**
     * @throws BuildExceptions
     */
    public function show(int $userId): JsonResponse
    {
        return response()->json(['user' => $this->userService->getOne($userId)], Response::HTTP_OK);
    }

    public function index(UserFormRequest $request): ResourceCollection
    {
        return new UserCollection(
            $this->userService->getPaginate($request->validated())
        );
    }
}
