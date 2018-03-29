<?php

namespace Admin;

use BaseController, App\Models\Order, Illuminate\Support\Facades\Input, View, Redirect, App\Models\Photo, App\Models\Artist, Config;

class OrderController extends BaseController {
    public function __construct() {
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
		curl_close($ch);
		return $response;
    }
	
	public function payArtist($id){
		// create the pay request
		$id = $_GET['id'];
		$order = Order::findOrFail($id);
		
		$getpaykey = Order::where('id','=',$id)->get();

		foreach ( $getpaykey as $key ) {
			$paykey = $key->paykey;
		}
		
		$createPacket = array(
			"payKey" => $paykey,
			"requestEnvelope" => array(
				"errorLanguage" => "en_US",
				"detailLevel" => "ReturnAll",
			),
		);
		
		$response = $this->_paypalSend($createPacket,Config::get('paypal.apiUrlArtist'));
		
		if ( !empty($response) && is_array($response) ) {
			$ack = $response['responseEnvelope'];
			if ( $ack['ack'] == 'Success' ) {
				$order->paid_artist = 1;
				$order->save();
				die('success');
			} else {
				$error = $response['error'][0];
				$message = $error['message'];
				die($message);
			}
		}
	}
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = Order::with('photo');
        $orders = $orders->where('paid', '=', 1);

        $orders = $orders->orderBy('created_at', 'DESC')->get();

        $artistList = $this->getArtistOptions();

		return View::make('admin.order.index', compact('orders', 'artistList'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order = Order::findOrFail($id);

		return View::make('admin.order.edit', compact('order'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$order = Order::findOrFail($id);

		if ($order->update(Input::all())) {
			return Redirect::route('admin.order.index')->with('success', 'Order updated.');
		}

		return Redirect::back()->withErrors($order->getErrors())->withInput();
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Order::destroy($id);

		return Redirect::route('admin.order.index')->with('success', 'Order deleted.');
	}

    /**
     * Returns artist options.
     *
     * @return mixed
     */
    private function getArtistOptions()
    {
        $artists = Artist::all();
        $options = array(0 => 'All artists');
        foreach ($artists as $artist) {
            $options[$artist->id] = $artist->display_name;
        }

        return $options;
    }
}
