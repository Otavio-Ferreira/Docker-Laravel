<?php

namespace App\Repositories\Settings\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EloquentUsersRepository implements UsersRepository
{
    public function getByEmail($email){
        return User::where('email', $email)->first();
    }

    public function getByUuid($uuid){
        return User::where('uuid', $uuid)->first();
    }

    public function getAll(){
        return User::get();
    }

    public function store($request){

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            'remember_token' => Str::random(10),
        ]);

        return $user;
    }

    public function store_all($request, $password){

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($password),
            'status' => true
        ]);

        return $user;
    }

    public function update($uuid){}

    public function updatePassword($request, $token){
        $user = $this->getByUuid($token->user_uuid);
        $user->password = Hash::make($request->password);
        $user->save();
    }

    public function delete($uuid){}

}
