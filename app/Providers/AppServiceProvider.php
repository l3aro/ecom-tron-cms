<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Theme;
use App\Models\MenuCat;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        $menu_name = 'top-menu';
        $menu_cat = MenuCat::where('name', 'top-menu')->first();
        if ($menu_cat) {
            Theme::uses('persuit')->bind('menu', function() use($menu_cat)  {
                return $menu = Menu::where([['cat', $menu_cat->id],['parent', 0]])->orderBy('order', 'asc')->get()
                ->map(function($q) {
                    $sub = $this->getSubMenuCategories($q->id);
                    $q->sub = $sub;
                    return $q;
                });
            });
        }
    }

    /**
     * Get list sub category of certain menu
     * 
     * @param int id of category where we search its sub
     * @param int id of current menu should be ignored
     * @return Collection the list sub
     * @return null
     */
    private function getSubMenuCategories($parent_id, $process_id=null) {
        $condition = [];
        $condition[] = ['parent', $parent_id];
        if ($process_id !== null) {
            $condition[] = ['id', '<>', $process_id];
        }
        $cat = Menu::where($condition)->orderBy('order','asc')->get();
        if ($cat->count() > 0) {
            $cat->map(function($q) use($process_id) {
                $sub = $this->getSubMenuCategories($q->id, $process_id);
                $q->sub = $sub;
                return $q;
            });
            return $cat;
        }
        return null;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }
}
