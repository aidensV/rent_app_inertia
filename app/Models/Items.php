<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'description',
        'type',
        'qty',
        'location',
        'guard_name',
        'updated_at',
        'created_at',
    ];
}
