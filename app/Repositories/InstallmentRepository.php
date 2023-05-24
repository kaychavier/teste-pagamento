<?php

namespace App\Repositories;

use App\Models\Installment as Model;

class InstallmentRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }
}
