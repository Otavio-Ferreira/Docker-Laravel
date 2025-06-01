<?php

namespace App\Repositories\Tokens\UserTokens;

interface UsersTokensRepository{
  public function getById($uuid); 
  public function getByUserUuid($uuid); 
  public function store($user, $type); 
  public function delete($uuid); 
} 