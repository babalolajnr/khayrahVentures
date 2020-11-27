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
    
    public function productCategory() {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Produts');
    }
}
