<?php

namespace App\Models;

use App\Traits\FormatCreatedAtAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes, FormatCreatedAtAttribute;

    protected $fillable = ["price", "payment_method", "client_id", "user_id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'purchase_products', 'purchase_id', 'product_id')
            ->withPivot(['quantity', 'id']);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class, 'purchase_id');
    }

    public function scopeSearch(Builder $query, array $params): Builder
    {
        if (isset($params['user']))
            $this->scopeUser($query, $params['user']);
        if (isset($params['client']))
            $this->scopeClient($query, $params['client']);
        if (isset($params['product']))
            $this->scopeProduct($query, $params['product']);
        return $query;
    }

    public function scopeUser(Builder $query, string $user): Builder
    {
        return $query->whereHas('user', fn (Builder $qr) => $qr->where('name', 'like', '%' . $user . '%'));
    }

    public function scopeClient(Builder $query, string $client): Builder
    {
        return $query->whereHas('client', fn (Builder $qr) => $qr->where('name', 'like', '%' . $client . '%'));
    }

    public function scopeProduct(Builder $query, string $product): Builder
    {
        return $query->whereHas('products', fn (Builder $qr) => $qr->where('name', 'like', '%' . $product . '%'));
    }
}
