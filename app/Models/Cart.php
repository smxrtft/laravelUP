<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['UserID', 'AdID'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'AdID');
    }
}
