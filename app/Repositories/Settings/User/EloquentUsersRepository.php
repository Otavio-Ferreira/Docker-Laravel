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

    public function update($uuid, $request){
        $user = $this->getByUuid($uuid);

        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        
        if ($request->filled('status')) {
            $user->status = $request->status;
        }       

        if ($request->filled('cpf')) {
            $user->cpf = $request->cpf;
        }

        if ($request->filled('birth')) {
            $user->birth = $request->birth;
        }

        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }        

        $user->save();

        return $user;
    }

    public function updatePassword($request, $uuid){
        $user = $this->getByUuid($uuid);
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    public function updateStatus($uuid, $status){
        $user = $this->getByUuid($uuid);
        $user->status = $status;
        $user->save();

        return $user;
    }

    public function updateLastLogin($uuid){
        $user = $this->getByUuid($uuid);
        $user->timestamps = false;
        $user->last_login_at = now();
        $user->save();
        $user->timestamps = true;
        return $user;
    }

    public function delete($uuid){
        $user = $this->getByUuid($uuid);
        $user->delete();
    }

}