<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['identifier', 'product', 'product_number', 'sender_name', 'sender_number', 'name', 'path', 'size'];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
