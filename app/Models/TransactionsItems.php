<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsItems extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(Items::class);
    }
}
