<?php

namespace App\Repositories;

use App\Models\PurchaseProduct as Model;

class PurchaseProductRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }
}
