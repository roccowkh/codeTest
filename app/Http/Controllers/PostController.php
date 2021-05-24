<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class PostController extends Controller
{
    //
    function getData(Request $req)
    {
    	return $req->input();
    }

	function convertCurrency(Request $req){
		$apikey = 'c93c85d0e6059bcb08af';
		$from_currency = "USD";
		$to_currency = "HKD";

		$from_Currency = urlencode($from_currency);
		$to_Currency = urlencode($to_currency);
		$query =  "{$from_Currency}_{$to_Currency}";

		// change to the free URL if you're using the free version
		$json = file_get_contents("https://free.currconv.com/api/v7/convert?q=USD_HKD&compact=ultra&apiKey=c93c85d0e6059bcb08af");
		$obj = json_decode($json, true);

		$val = floatval($obj["$query"]);

		$amount = $req->input('usd');
		$total = $val * $amount;
		$this->storeRecord($amount, $val);
    	return view('test', ['value' => (number_format($total, 2, '.', ''))]);
	}

	function storeRecord($amount, $rate) {
		$record = new Currency;
		$record->rate = $rate;
		$record->convertedAmount = $amount;
		$record->save();
	}
}
