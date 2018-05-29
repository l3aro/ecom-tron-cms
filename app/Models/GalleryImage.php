<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galleryimage extends Model
{
    protected $table = 'gallery_image';
    protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    public function gallery() {
        return $this->belongsTo('App\Models\Gallerycat', 'gallery_id');
    }
}
