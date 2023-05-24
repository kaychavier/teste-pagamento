<?php

namespace App\Repositories;

use App\Interfaces\NeedConstructor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository implements NeedConstructor
{
  protected $model;

  public function all(): Collection
  {
    return $this->model->all();
  }

  public function paginate(int $limit = 10): LengthAwarePaginator
  {
    return $this->model->paginate($limit);
  }

  public function find(string|int $id)
  {
    return $this->model->find($id);
  }

  public function findOrFail(string|int $id)
  {
    return $this->model->findOrFail($id);
  }

  public function first()
  {
    return $this->model->first();
  }

  public function count(): int
  {
    return $this->model->count();
  }

  public function create(array $data)
  {
    return $this->model->create($data);
  }

  public function query(): Builder
  {
    return $this->model->query();
  }

  public function firstOrCreate(array $data)
  {
    return $this->model->firstOrCreate($data);
  }

  public function update(string|int $id, array $data)
  {
    $model = $this->findOrFail($id);
    $model->update($data);
    return $model;
  }

  public function delete(string|int $id)
  {
    return $this->findOrFail($id)->delete();
  }

  public function forceDelete(string|int $id)
  {
    return $this->model->withTrashed()->findOrFail($id)->forceDelete();
  }

  public function restore(string|int $id)
  {
    return $this->model->withTrashed()->findOrFail($id)->restore();
  }

  public function new()
  {
    return $this->model->make();
  }
}
