<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';

    protected $fillable = ['name', 'user_id', 'name2', 'name3', 'products_category_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    public function product_category() {
        return $this->belongsTo('App\Models\Product_Category');
    }
}
