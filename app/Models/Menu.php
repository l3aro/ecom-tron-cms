<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $_options = '';
    protected $_menus = '';
    protected $table = 'menu';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'updated_at'
    ];
    public function menuUpdateBy() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}
	public function menu_cat() {
        return $this->belongsTo('App\Models\Menucat', 'cat');
    }
	public function subMenus() {
		return $this->hasMany('App\Models\Menu', 'parent', 'id')->orderBy('order', 'desc');
	}
	public function allSubMenus() {
		return $this->subMenus()->with('allSubMenus');
	}
}
