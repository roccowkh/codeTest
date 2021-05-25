<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyRate;

class CurrencyController extends Controller
{
    function getCurrentRate() {
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

        
        return $val;
    }

    function convertCurrency(Request $req){
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
        $rate = $this->getCurrentRate();
        $yesterday = date("Y-m");
        $day = date("d")-1;
        $yesterday = "$yesterday-$day";
        $yesterdayRate = $this->getDailyValueFromDB($yesterday);
        $percent = $this->getPercentageDifference($rate, $yesterdayRate);
        return view('test', ['rate' => $rate, 'yesterdayRate' => $yesterdayRate, 'percent' => $percent, 'value' => (number_format($total, 2, '.', '')), 'usd' => $amount]);
    }

    function getPercentageDifference($rateTdy, $rateYtd) {
        return (($rateTdy-$rateYtd)/$rateYtd)*100;
    }

   /* function storeRecord($amount, $rate) {
        $record = new Currency;
        $record->rate = $rate;
        $record->convertedAmount = $amount;
        //$record->save();
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $yesterday = date("Y-m");
        $day = date("d")-1;
        $yesterday = "$yesterday-$day";
        $today = date("Y-m-d");
        $rate = $this->getDailyValueFromDB($today);
        $yesterdayRate = $this->getDailyValueFromDB($yesterday);
        $percent = $this->getPercentageDifference($rate, $yesterdayRate);
        return view('home', ['rate' => $rate, 'yesterdayRate' => $yesterdayRate, 'percent' => $percent]);
        
    }

    function getDailyValueFromDB($date) {

        $rateObj = DailyRate::where('date', $date)->first();
        if ($rateObj == false) {
            return $this->getAndStoreDailyRate($date);
        } else {
            return $rateObj['rate'];
        }
        if (count($rates) == 0 ) {
            return $this->getAndStoreDailyRate($date);
        }
        foreach($rates as $rate) {
            if (strpos($rate["date"], $date) !== false ){
                return $rate["rate"];
            } else {
                return $this->getAndStoreDailyRate($date);
            }
        }
    }

    function getAndStoreDailyRate($date) {
        $apikey = env('FREE_API_KEY');
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=USD_HKD&compact=ultra&date=$date&apiKey=c93c85d0e6059bcb08af");
        $obj = json_decode($json, true);
        $result = $obj["USD_HKD"]["$date"];
        $dailyRate = new DailyRate;
        $dailyRate->rate =  $result;
        $dailyRate->date = $date;
        $dailyRate->save();
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
