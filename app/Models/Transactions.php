<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    // protected $appends = ['end_time'];
    // protected function startTime(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),
    //     );
    // }

    protected function endTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::createFromFormat('H:i:s', $value, 'Asia/Jakarta')->addHours(7)->format('H:i') : '-',
        );
    }
    public function item()
    {
        return $this->belongsTo(Items::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
