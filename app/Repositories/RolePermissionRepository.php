<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission as Model;
use App\Models\RolePermission;

class RolePermissionRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }

  public function firstOrCreateByNames(string $role, string $permission): RolePermission
  {
    $role_id = Role::query()->firstOrCreate(['name' => $role])->id;
    $permission_id = Permission::query()->firstOrCreate(['name' => $permission])->id;
    return $this->firstOrCreate(compact('role_id', 'permission_id'));
  }
}
