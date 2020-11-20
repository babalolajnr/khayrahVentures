<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    use HasFactory;

    protected $table = 'products_category';

    protected $fillable = ['name', 'user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
