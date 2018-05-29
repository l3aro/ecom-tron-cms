<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailContent extends Model
{
    protected $table = 'email_content';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
}