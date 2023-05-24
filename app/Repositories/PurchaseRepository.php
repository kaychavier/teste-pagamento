<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Product;
use App\Models\Purchase as Model;
use App\Models\PurchaseProduct;

class PurchaseRepository extends AbstractRepository
{
  public function __construct()
  {
    $this->model = new Model;
  }

  public function list(int $limit = 10, array $params = [])
  {
    $query = $this->query();
    $query->with(['client', 'user', 'products', 'installments']);
    if (!auth()->user()->role->hasPermission('admin resources')) {
      $query->where('user_id', auth()->id());
    }
    $query->search($params);
    return $query->paginate($limit);
  }

  public function getFormAttributes($id = null)
  {
    $isAdmin = auth()->user()->role->hasPermission('admin resources');
    return [
      'purchase' => $id ? $this->findOrFail($id)->load(['installments', 'products']) : $this->new()->load(['installments', 'products']),
      'clients'  => $isAdmin ? Client::all() : Client::where('user_id', auth()->id())->get(),
      'products' => $isAdmin ? Product::all() : Product::where('user_id', auth()->id())->get(),
    ];
  }

  public function createWithRelations(array $data): Model
  {
    $purchase = $this->create($data + ['user_id' => auth()->id()]);
    foreach ($data['products'] as $product) {
      PurchaseProduct::create($product + ['purchase_id' => $purchase->id]);
    }
    foreach ($data['installments'] as $installment) {
      $purchase->installments()->create($installment);
    }
    return $purchase;
  }

  public function updateWithRelations($id, array $data): Model
  {
    $purchase = $this->findOrFail($id);
    PurchaseProduct::where('purchase_id', $purchase->id)->delete();
    foreach ($data['products'] as $product) {
      PurchaseProduct::create($product + ['purchase_id' => $purchase->id]);
    }
    $purchase->installments()->delete();
    $purchase->installments()->createMany($data['installments']);
    $purchase->update($data);
    return $purchase;
  }
}
