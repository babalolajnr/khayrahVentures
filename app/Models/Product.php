<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function productCategory()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public function sizes()
    {
        return $this->belongsTo('App\Models\Size', 'size_id');
    }

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory');
    }

    public static function validateIncomingRequest($request)
    {
        $messages = [
            'unique'            => 'Size Exists',
            'code.required_if'  => 'Code field required when product category is mattresses',
            'color.required_if' => 'Color field required when product category is mattresses'
        ];

        $validator =  $request->validate(([
            'name'              => ['required'],
            'code'              => ['required_if:productCategory,==, Mattresses'],
            'productCategory'   => ['required'],
            'color'             => ['required_if:productCategory,==, Mattresses'],
            'wholesale'         =>  ['required'],
            'retail'            =>  ['required'],
            'size'              =>  ['required_if:productCategory,==, Mattresses'],
            'brand'             =>  ['required'],
            'quantity'          =>  ['integer']
        ]), $messages);

        return $validator;
    }
}
