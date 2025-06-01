<?php

namespace App\Repositories\Tokens\UserTokens;

use App\Models\User;
use App\Models\UserTokens;

class EloquentUsersTokensRepository implements UsersTokensRepository
{
    public function getById($uuid)
    {
        return UserTokens::find($uuid);
    }

    public function getByUserUuid($uuid)
    {
        return UserTokens::where('user_uuid', $uuid)->orderBy('created_at', 'desc')->first();
    }

    public function store($user, $type)
    {
        $userToken = UserTokens::create([
            "user_uuid" => $user->uuid,
            "type" => $type,
        ]);

        return $userToken;
    }

    public function delete($uuid) {
        $token = $this->getById($uuid);
        $token->delete();
    }
}
