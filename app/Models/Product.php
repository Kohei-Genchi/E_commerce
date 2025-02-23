<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable=[
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    protected $casts=[
        'price'=>'decimal:2',
        'stock'=>'integer'
    ];

    protected $appends=['average_rating'];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(Review::class);
    }
    public function getAverageRatingAttribute(): float{
        return $this->reviews()->avg('rating') ?? 0.0;
    }
    public function getReviewCountAttribute(): int{
        return $this->reviews()->count();
    }
    public function isInStock(): bool{
        return $this->stock > 0;
    }
    public function reduceStock(int $quantity =1): bool{
        if($this->stock >= $quantity){
            $this->decrement('stock',$quantity);
            return true;
        }
        return false;
    }
}
