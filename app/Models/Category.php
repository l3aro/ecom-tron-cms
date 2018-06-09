<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'created_at'
    ];

    public function article() {
        return $this->hasMany('App\Models\Article', 'cat');
	}
	
	public function product() {
		return $this->hasMany('App\Models\Product', 'cat');
	}

    public function user() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}
}
