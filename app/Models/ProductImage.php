<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productimage extends Model
{
    protected $table = 'product_image';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
}
