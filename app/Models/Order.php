<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//sachi

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['translation_id', 'user_id', 'file_id', 'upload_file_id', 'payment_id', 'code', 'status', 'accepted', 'pages', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function translation()
    {
        return $this->belongsTo(Translation::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function uploadFiles()
    {
        return $this->hasMany(UploadFile::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
