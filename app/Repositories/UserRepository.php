<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User as Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }

  public function createByRole(array $data, string $role): User
  {
    $role_id = Role::query()->firstWhere('name', $role)?->id;
    return $this->create($data + compact('role_id'));
  }

  public function listUsers(int $limit = 10): LengthAwarePaginator
  {
    $filter = fn (Builder $query) => $query->where('name', '!=', 'Admin');
    return $this->query()->whereHas('role', $filter)->orWhereDoesntHave('role')->with('role')
      ->paginate($limit);
  }
}
