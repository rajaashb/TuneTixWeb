<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['concert_id', 'type', 'price', 'quantity'];

    // A ticket belongs to a concert
    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    // A ticket belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
