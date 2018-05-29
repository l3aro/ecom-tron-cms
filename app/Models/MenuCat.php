<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menucat extends Model
{
    protected $table = 'menu_cat';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    
    public function menu_cat() {
        return $this->hasMany('App\Models\Menu', 'cat');
    }

    public function menuUpdateBy() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}
}
