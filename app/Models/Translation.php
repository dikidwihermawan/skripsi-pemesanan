<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'type', 'process'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
