<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An order can have many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
