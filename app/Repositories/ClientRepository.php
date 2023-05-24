<?php

namespace App\Repositories;

use App\Models\Client as Model;

class ClientRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }

  public function listByAuthRole(int $limit = 10){
    $user = auth()->user();
    if($user->hasPermission('admin resources')) return $this->paginate($limit);
    return $this->query()->where('user_id', $user->id)->paginate($limit);
  }
}
