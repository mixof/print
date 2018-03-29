<?php

use \App\Models\Photo;
use \App\Models\Artist;
use \App\Models\Order;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Public Section */

Route::get('/', function()
{
    $catchempty = Photo::with('artist')->where('exclude_homepage',0)->where('hide_photo',0)->get();
    if ( $catchempty->count() ) {

        /* Line 1: Random */
        $photos_ID_1 = array();
        $photos_line1 =Photo::with(array('artist'=>function($query){ $query->where('deactive_account', '==',0);
        }))->where('exclude_homepage',0)->where('hide_photo',0)->whereNull('deleted_at')->orderByRaw('RAND()')->take(6)->get();
        foreach ( $photos_line1 as $photos_1 ) { $photos_ID_1[] = $photos_1->id; }

        /* Line 2: Random */
        $photos_ID_2 = array();
        $photos_line2 = Photo::with(array('artist'=>function($query){ $query->where('deactive_account', '==',0);
        }))->where('exclude_homepage',0)->where('hide_photo',0)->whereNull('deleted_at')->whereNotIn('id', $photos_ID_1)->orderByRaw('RAND()')->take(6)->get();
        foreach ( $photos_line2 as $photos_2 ) { $photos_ID_2[] = $photos_2->id; }

        /* Line 2: Random */
        if ( count($photos_ID_2) < 6 ) {
            $photos_line2 = Photo::with(array('artist'=>function($query){ $query->where('deactive_account', '==',0);
            }))->where('exclude_homepage',0)->where('hide_photo',0)->whereNull('deleted_at')->orderByRaw('RAND()')->take(6)->get();
            $photos_ID_2 = array();
            foreach ( $photos_line2 as $photos_2 ) { $photos_ID_2[] = $photos_2->id; }
        }

        /* Line 3: Random */
        $photos_ID_3 = array_merge($photos_ID_1,$photos_ID_2);
        $photos_line3 = Photo::with(array('artist'=>function($query){  $query->where('deactive_account', '==',0);
        }))->where('exclude_homepage',0)->where('hide_photo',0)->whereNotIn('id', $photos_ID_3)->whereNull('deleted_at')->orderByRaw('RAND()')->take(6)->get();



    } else {
        $photos_line1 = array();
        $photos_line2 = array();
        $photos_line3 = array();
    }

    return View::make('index', array('photos_group' => array( 'photos_line1'=>$photos_line1,'photos_line2'=>$photos_line2,'photos_line3'=>$photos_line3 )));
});

Route::get('/information', function() {
    return View::make('information');
});

Route::get('/faq', function() {
    return View::make('faq');
});

Route::get('/rate-printer', function() {
    return View::make('rate-printer');
});

Route::get('/contact-us', function() {
    return View::make('contact-us');
});

Route::get('/terms', function() {
    return View::make('terms');
});
Route::get('/paypal-cancelled/{slug}',['as'=>'paypal.cancel','uses'=> function($slug) {
    return View::make('paypal-cancelled')->with('slug',$slug);
}]);

Route::get('/browse', ['as' => 'photo.index', 'uses' => 'PhotoController@index']);
Route::get('/browse/imageType/{id}/category/{slug}', ['as' => 'photo.index.category', 'uses' => 'PhotoController@index']);
Route::get('/browse/imageType/{id}', ['as' => 'photo.index.imageType', 'uses' => 'PhotoController@indexImageType']);
Route::get('/photo/{slug}', ['as' => 'photo.show', 'uses' => 'PhotoController@show']);
Route::get('/photo/{slug}/buy', ['as' => 'photo.buy', 'uses' => 'PhotoController@buy']);
Route::get('/photo/{slug}/download/{oid}', ['as' => 'photo.download', 'uses' => 'PhotoController@download']);

Route::get('/artist/{slug}', ['as' => 'artist.show', 'uses' => 'ArtistController@show']);
Route::get('/artist/nophoto/{id}', ['as' => 'artist.nophoto', 'uses' =>'ArtistController@nophoto']);

Route::get('/print/hash/{hash}', function ($hash) {
    $order = Order::where('hash', '=', $hash)->first();

    if ($order) {
        if ($order->printed) {
            return Response::json([
                'success' => 0,
                'error' => 'Already Printed'
            ]);
        } else {
            $order->printed = 1;
            $order->save();

            return Response::json([
                'success' => 1,
                'orientation' => $order->photo->orientation,
                'photo_url' => $order->photo->large_file_url
            ]);
        }
    } else {
        return Response::json([
            'success' => 0,
            'error' => 'Invalid Hash'
        ]);
    }
});

/* Admin Section */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function()
{
    Route::get('login', ['as' => 'admin.login', 'uses' => 'SessionController@create']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'SessionController@destroy']);
    Route::resource('session', 'SessionController', ['only' => ['create', 'store', 'destroy']]);
});

Route::group(['before' => 'auth.admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function()
{
    Route::get('/', function () {
        return Redirect::route('admin.order.index');
    });

    Route::resource('order', 'OrderController', ['except' => ['create', 'store', 'show']]);
    Route::resource('photo', 'PhotoController', ['except' => ['show']]);
    Route::resource('artist', 'ArtistController', ['except' => ['show']]);
    Route::get('artist/invite/{id}', ['as' => 'admin.artist.invite', 'uses' =>'ArtistController@invite']);
    Route::get('artist/deactivate/{id}', ['as' => 'admin.artist.deactivate', 'uses' =>'ArtistController@deactivate']);
    Route::get('artist/pay/{id}', ['as' => 'admin.pay.artist', 'uses' =>'OrderController@payArtist']);

    Route::get('admin.pay.artist', function() {
        Log::info("route!");
        if (Request::ajax()) {
            Log::info("ajax");
            Artisan::call('down');
        }
    });

    Route::get('photo/hide/{id}', ['as' => 'admin.photo.hide', 'uses' =>'PhotoController@hide']);


    Route::get('category/removeSub/{subId}/{categoryId}', ['as' => 'admin.category.removeSub', "uses" =>'CategoryController@removeSubcategory']);
    Route::get('category/addSub/{id}', ['as' => 'admin.category.addSub', 'uses' =>'CategoryController@addSubcategory']);
    Route::put('category/saveSub/{id}', ['as' => 'admin.category.saveSub', 'uses' =>'CategoryController@saveSubcategory']);

    Route::resource('category', 'CategoryController', ['except' => ['show']]);
    Route::resource('imageType', 'ImageTypeController', ['except' => ['show']]);
    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::resource('profane', 'ProfaneController');
});

/* Artist accounts */
Route::get('login', ['as' => 'login', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionController@destroy']);
Route::resource('session', 'SessionController', ['only' => ['create', 'store', 'destroy']]);

Route::group(['before' => 'auth'], function()
{
    Route::resource('user', 'UserController', ['only' => ['edit', 'update']]);
    Route::resource('artist', 'ArtistController', ['only' => ['show', 'edit', 'update']]);
    Route::resource('artist.photo', 'ArtistPhotoController', ['only' => ['index', 'edit', 'update']]);
    Route::post('artist/photo/update_field', ['as' => 'artist.photo.update_field', 'uses' =>'ArtistPhotoController@update_field']);
});

Route::match(array('GET', 'POST'), 'user/signup/{invite}', ['as' => 'user.signup', 'uses' =>'UserController@signup']);


Route::get('/request-membership', [
    'as' => 'request-membership',
    'uses'=>'RequestMembershipController@request_membership'
]);

Route::post('/send', [
    'as' => 'send',
    'uses'=>'RequestMembershipController@send'
]);

Route::get('/states/{id}', [
    'as' => 'states',
    'uses'=>'UserController@states'
]);

Route::get('/paypal/{slug}', [
    'as' => 'paypal',
    'uses'=>'PhotoController@paypal'
]);

Route::get('/password/remind', [
    'as' => 'password.remind',
    'uses'=>'RemindersController@getRemind'
]);
Route::post('/password/remind', [
    'as' => 'password.remindPost',
    'uses'=>'RemindersController@postRemind'
]);
Route::get('/password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'RemindersController@getReset'
]);
Route::post('password/reset/{token}', [
    'as' => 'password.update',
    'uses' => 'RemindersController@postReset'
]);