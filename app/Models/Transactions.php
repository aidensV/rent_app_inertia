<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    // protected $appends = ['start_time', 'end_time'];
    // protected function startTime(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),
    //     );
    // }

    // protected function endTime(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),
    //     );
    // }
    public function item()
    {
        return $this->belongsTo(Items::class);
    }
}
