<?php

use App\Models\ImageType;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Order;

class PhotoController extends BaseController {
	public $paykey = "";
	public $args;
	public $headers;
	
	public function __construct(){
		$this->headers = array(
			"X-PAYPAL-SECURITY-USERID: ".Config::get('paypal.api_user'),
			"X-PAYPAL-SECURITY-PASSWORD: ".Config::get('paypal.api_pass'),
			"X-PAYPAL-SECURITY-SIGNATURE: ".Config::get('paypal.api_sig'),
			"X-PAYPAL-REQUEST-DATA-FORMAT: JSON",
			"X-PAYPAL-RESPONSE-DATA-FORMAT: JSON",
			"X-PAYPAL-APPLICATION-ID: ".Config::get('paypal.app_id'),
		);
    }
	
	public function _paypalSend($data,$url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
		$response = json_decode(curl_exec($ch),true);
		return $response;
    }
	
	public function splitPayStore($args,$slug = null){
		// create the pay request
		$createPacket = array(
			"actionType" =>"PAY_PRIMARY",
			"clientDetails" => array( "applicationId" => Config::get('paypal.app_id') ),
			"currencyCode" => "USD",
			"feesPayer"		=>"EACHRECEIVER",
			"receiverList" => array(
				"receiver" => array(
					array(
						"amount"=> $args['price'],
						"email"=> Config::get('paypal.primaryemail'),
						"primary"=> true
					),
					array(
						"amount"=> (60 / 100) * $args['price'], // Split 60% Share of payment
						"email"=>$args['artist_email'],
						"primary"=> false
					),
				),
			),
			"returnUrl" => $args['returnURL'],
			"cancelUrl" => URL::route('paypal.cancel', [$slug]),
			"requestEnvelope" => array(
				"errorLanguage" => "en_US",
				"detailLevel" => "ReturnAll",
			),
		);
	    
		
		$response = $this->_paypalSend($createPacket,Config::get('paypal.apiUrlStore'));
		return $response;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id="", $slug="") {
        $seed = Session::get('browseSeed', rand(1, 10000));
        if (!Input::get('page')) {
            $seed = rand(1, 10000);
        }
        Session::set('browseSeed', $seed);
        Session::save();

        // Category filtering
        if ($slug)
        {
			$category = Category::findBySlug($slug);
			$categoryId = $category->id;
			$query = Photo::inCategory($categoryId);
			/*
			if($category->children->count()) {
				$categoryId = $category->id;
				$query = Photo::inCategoryOrIsChild($slug, $categoryId);
			} else {
				$query = Photo::inCategory($slug);
			}
			*/
		} else {
            $query = Photo::select();
        }

        // Price filtering
        if (is_numeric(Input::get('min_price')))
        {
            $query->isPriced(Input::get('min_price'), Input::get('max_price'));
        }

        // Search
        if (Input::get('q'))
        {
            $query->search(Input::get('q'));
        }

        $photos = $query->with(array('artist'=>function($query){  $query->where('deactive_account', '==',0);
        }))->where('hide_photo', '==', 0)->whereNull('deleted_at')->orderByRaw('RAND(' . $seed . ')')->paginate(30);
		$artCategories = ImageType::find(2)->categories()->where('parent_id', '==', 0)->orderBy('name')->get();
		$photoCategories = ImageType::find(1)->categories()->where('parent_id', '==', 0)->orderBy('name')->get();
        $categories = Category::where('parent_id', '==', 0)->orderBy('name')->get();
        if($slug){
			foreach($photos as $key => $photo){
				if(!in_array($categoryId,$photo->category_id)){
					$photos->forget($key);
				}
			}
		}
		
        return View::make('photo.index', compact('photos', 'categories', 'artCategories', 'photoCategories'));
    }

	public function indexImageType($id = 1)
	{
		if($id > 0) {
			$seed = Session::get('browseSeed', rand(1, 10000));
			if (!Input::get('page')) {
				$seed = rand(1, 10000);
			}
			Session::put('browseSeed', $seed);

			// ImageType filtering
			$query = Photo::inImageType($id);

			// Price filtering
			if (is_numeric(Input::get('min_price'))) {
				$query->isPriced(Input::get('min_price'), Input::get('max_price'));
			}

			// Search
			if (Input::get('q')) {
				$query->search(Input::get('q'));
			}

			$photos = $query->with(array('artist' => function ($query) {
				$query->where('deactive_account', '==', 0);
			}))->where('hide_photo', '==', 0)->whereNull('deleted_at')->orderByRaw('RAND(' . $seed . ')')->paginate(30);
			$categories = Category::orderBy('name')->get();
			$artCategories = ImageType::find(2)->categories()->where('parent_id', '==', 0)->orderBy('name')->get();
			$photoCategories = ImageType::find(1)->categories()->where('parent_id', '==', 0)->orderBy('name')->get();

			return View::make('photo.index', compact('photos', 'categories', 'artCategories', 'photoCategories'));
		}
	}


    /**
     * Show the specified resource.
     *
     * @param  str $slug
     * @return Response
     */
    public function show($slug)
    {
        $photo = Photo::where('slug', '=', $slug)->firstOrFail();
        if(!$photo->hide_photo){
			$links = $photo->nextPrevLinks();
			return View::make('photo.show', compact('photo','links'));
        }else
            abort(404);

    }


    /**
     * Show the buy page for the specified resource.
     *
     * @param  str $slug
     * @return Response
     */
    public function buy($slug)
    {
        $photo = Photo::where('slug', '=', $slug)->firstOrFail();
        return View::make('photo.buy', compact('photo'));
    }

    public function paypal($slug)
    {
		$photo = Photo::where('slug', '=', $slug)->firstOrFail();
		$order = new Order;
		$order->photo_id = $photo->id;
        $order->amount = $photo->price;
		$order->hash = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 8);
        $order->save();
		
		$this->args = array(
			'returnURL' 	=> URL::route('photo.download', [$photo->slug, base64_encode($order->id)]),
			'price'			=> $photo->price,
			'artist_email'	=> $photo->artist->paypal_email
		);
		$this->paykey = $this->splitPayStore($this->args,$photo->slug);

		
        //$order->user_id = Auth::user()->id;
		$paykeyCollection = collect($this->paykey);
		if($paykeyCollection->has('payKey')) {
			$order->paykey = $this->paykey['payKey'];
			$order->save();

			$redirect_paypal = Config::get('paypal.paypalUrl') . $this->paykey['payKey'];

			return Redirect::away($redirect_paypal);
		} else {
			$error = $this->paykey['error'];
			$firstError = $error[0];
			$errorMessage = 'PayPal returned an error: ' . $firstError['message'];
			$order->paykey = $errorMessage;
			$order->save();
			Log::error($errorMessage);
			return View::make('photo.buy', compact('photo'))->withErrors($errorMessage);
		}
        //return View::make('photo.download', compact('photo', 'order'));
    }

    /**
     * Show the download page for the specified resource.
     *
     * @param  str $slug
     * @return Response
     */
    public function download($slug, $oid)
    {
        //return  Auth::user();


        $photo = Photo::where('slug', '=', $slug)->firstOrFail();
        //$order = Order::where('user_id', Auth::id())->where('id', $oid)->get();
        $order = Order::where('id', base64_decode($oid))->get();

        if(!count($order))
            return Redirect::to('/');

        $order[0]->paid = 1;
        $order[0]->save();

        //return $order[0]->hash;
        /*$order = new Order;
        $order->photo_id = $photo->id;
        $order->amount = $photo->price;
        $order->paid = 1;
        $order->hash = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 8);
        $order->save();*/

        return View::make('photo.download', compact('photo', 'order'));
    }

}
