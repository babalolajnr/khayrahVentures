<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasOne('App\Models\Product');
    }

}
