<?php

namespace App\Repositories;

use App\Models\Role as Model;

class RoleRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }

  public function findByName(string $name): ?Model
  {
    return $this->query()->firstWhere('name', $name);
  }

  public function getIdByName(string $name): ?int
  {
    return $this->findByName($name)?->id;
  }

  public function createWithPermissions(array $data): Model
  {
    $role = $this->create($data);
    if (isset($data['permissions']))
      $role->permissions()->sync($data['permissions']);
    return $role;
  }

  public function updateWithRoles(int|string $id, array $data): Model
  {
    $role = $this->update($id, $data);
    if (isset($data['permissions']))
      $role->permissions()->sync($data['permissions']);
    return $role;
  }
}
