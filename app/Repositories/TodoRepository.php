<?php

namespace App\Repositories;

use Exception;
use App\Models\Todo;
use App\Models\User;
use App\Http\Requests\StoreTodoRequest;

class TodoRepository
{
    /**
     * Create a Todo from Http Request
     *
     * @param StoreTodoRequest $request
     * @param User $user
     * @return Todo|null
     */
    public static function createFromRequest(StoreTodoRequest $request, User $user): ?Todo
    {
        try {
            $fields = [
                ...$request->all(),
                'user_id' => $user->id,
            ];

            return Todo::create($fields);
        } catch (Exception $e) {
            throw $e;
        }
    }
}