<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
    protected $table = 'upload_files';
    protected $fillable = ['identifier', 'name', 'path', 'size'];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
