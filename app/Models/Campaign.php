<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'discount'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_campaigns');
    }
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
