<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    public function gallery_cat() {
        return $this->belongsTo('App\Models\Gallerycat', 'cat');
    }
    public function galleryUpdateBy() {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
	public function gallery_image() {
        return $this->hasMany('App\Models\Galleryimage', 'gallery_id');
	}
}
