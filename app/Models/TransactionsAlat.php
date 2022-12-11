<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsAlat extends Model
{
    use HasFactory;
    protected $table = "transactions_alat";
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Items()
    {
        return $this->hasMany(TransactionsItems::class, 'transactions_alat_id','id');
    }
}
