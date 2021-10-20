<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    public $group;

    protected $fillable = [
        'id',
        'name',
        'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class );
    }
}
