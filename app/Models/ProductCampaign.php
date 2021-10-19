<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCampaign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'product_id',
        'campaign_id'
    ];
}
