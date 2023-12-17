<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'capacity',
        'fuel',
        'price',
        'boat_img',
        'boat_vid',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
