<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public static function validateIncomingRequest($request, $productAvailableQuantity)
    {

        $validator = $request->validate([
            'product_id'                => ['required', 'integer'],
            'quantity'                  => ['required', 'integer', 'max:' . $productAvailableQuantity],
            'customer_firstname'        => ['required', 'string'],
            'customer_lastname'         => ['required', 'string'],
            'customer_phone_number'     => ['required', 'unique:customers,phone_number'],
            'customer_email'            => ['required', 'unique:customers,email', 'email'],
            'address'                   => ['string']
        ]);

        return $validator;
    }
}
