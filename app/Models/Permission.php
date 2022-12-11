<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    protected $fillable = [
        'name',
        'type',
        'guard_name',
        'updated_at',
        'created_at',
    ];
}
