<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'brands';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'short_name'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany('App\Models\Produts');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }


}
