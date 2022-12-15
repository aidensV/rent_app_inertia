<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormClearance extends Model
{
    use HasFactory;
    protected $table = "form_clearance";

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
