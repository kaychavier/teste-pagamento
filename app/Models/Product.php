<?php

namespace App\Models;

use App\Traits\FormatCreatedAtAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, FormatCreatedAtAttribute;
    protected $fillable = ["name", "description", "price", "image", "user_id"];
    protected $appends = ["image_path", "formated_price"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(Purchase::class, 'purchase_products', 'product_id', 'purchase_id');
    }

    public function getImagePathAttribute()
    {
        if (!$this->image) return;
        return asset('storage/' . $this->image);
    }

    public function getFormatedPriceAttribute(){
        return 'R$ ' . number_format($this->price, 2, ',', '.');
    }
}
