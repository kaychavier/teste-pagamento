<?php

namespace App\Repositories;

use App\Models\Permission as Model;

class PermissionRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }
}
