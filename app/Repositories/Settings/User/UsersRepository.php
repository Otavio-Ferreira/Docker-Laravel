<?php

namespace App\Repositories\Settings\User;

interface UsersRepository{
  public function getByEmail($email); 
  public function getByUuid($uuid); 
  public function getAll(); 
  public function store($request); 
  public function store_all($request, $password); 
  public function update($uuid); 
  public function updatePassword($request, $token);
  public function delete($uuid); 
} 