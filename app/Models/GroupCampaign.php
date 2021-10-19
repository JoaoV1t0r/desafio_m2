<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupCampaign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'group_id',
        'campaign_id'
    ];
}
