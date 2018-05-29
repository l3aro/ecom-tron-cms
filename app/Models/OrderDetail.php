<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'order_detail';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at','updated_at'
    ];
}
