<?php

namespace App\Repositories\Settings\Roles;

interface RolesRepository{
  public function getAll();
  public function set($user, $role);
  public function update($user, $role);
  public function create($request);
  public function updateRole($request, $id);
} 