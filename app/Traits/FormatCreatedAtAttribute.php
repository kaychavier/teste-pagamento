<?php

namespace App\Traits;

use Carbon\Carbon;

trait FormatCreatedAtAttribute
{
  public function getCreatedAtAttribute(?string $value)
  {
    return Carbon::parse($value)->format('d/m/Y');
  }
}
