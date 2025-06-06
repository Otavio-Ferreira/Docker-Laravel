<?php

namespace App\Repositories\Settings\User;

interface UsersRepository{
  public function getByEmail($email); 
  public function getByUuid($uuid); 
  public function getAll(); 
  public function store($request); 
  public function store_all($request, $password); 
  public function update($uuid, $request); 
  public function updatePassword($request, $uuid);
  public function updateStatus($uuid, $status);
  public function updateLastLogin($uuid);
  public function delete($uuid); 
} 