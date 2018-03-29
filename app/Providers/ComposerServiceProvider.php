<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\ImageType;
use App\Models\Artist;

class ComposerServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->make('view')->composer('*', function($view) {
            $view->with('categories', Category::orderBy('name')->get());
            $view->with('photoCategories', ImageType::find(1)->categories()->where('parent_id', '==', 0)->orderBy('name')->get());
            $view->with('digitalCategories', ImageType::find(2)->categories()->where('parent_id', '==', 0)->orderBy('name')->get());
            $view->with('artists', Artist::where('deactive_account', '==',0)->orderBy('display_name')->get());
        });
    }
}