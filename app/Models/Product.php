<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    public function product_cat() {
        return $this->belongsTo('App\Models\Productcat', 'cat');
    }
    public function productUpdateBy() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}
}
