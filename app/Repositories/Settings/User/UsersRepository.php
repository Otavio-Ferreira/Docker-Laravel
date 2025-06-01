<?php

namespace App\Repositories\Settings\User;

interface UsersRepository{
  public function getByEmail($email); 
  public function getByUuid($uuid); 
  public function getAll($uuid); 
  public function store($request); 
  public function update($uuid); 
  public function updatePassword($request, $token);
  public function delete($uuid); 
} 