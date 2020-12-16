<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $table = 'brands';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany('App\Models\Produts');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function validateIncomingRequest($request)
    {
        $messages = [
            'unique' => 'Brand Exists'
        ];

        $validator = $request->validate(array(
            'name' => 'required|unique:brands',
        ), $messages);

        return $validator;
    }
}
