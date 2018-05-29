<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'component';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    public function comUpdateBy() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}
}