<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'item_id');
    }
}
