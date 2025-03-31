<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;
    
    // A concert can have many tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
