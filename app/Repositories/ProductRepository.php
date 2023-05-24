<?php

namespace App\Repositories;

use App\Models\Product as Model;

class ProductRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }

  public function listByAuthRole(int $limit = 10){
    $role = auth()->user()->role;
    if($role->hasPermission('admin resources')) return $this->paginate($limit);
    return $this->query()->where('user_id', auth()->id())->paginate($limit);
  }
}
