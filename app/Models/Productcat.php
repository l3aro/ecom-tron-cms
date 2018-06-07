<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    protected $_options = '';
    protected $_menus = '';
    protected $table = 'product_cat';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    public function user() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}
	public function product() {
        return $this->hasMany('App\Models\product', 'cat');
	}
	
}
