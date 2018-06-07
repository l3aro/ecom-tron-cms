<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function article_cat() {
        return $this->belongsTo('App\Models\ArticleCat', 'cat');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
