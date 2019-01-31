<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Rave;

class RaveController extends Controller
{
    //

    public function index() {
        return view("pizza.index");
    }
    public function initialize(Request $request) {
        //     $id = $this->request->subaccount_id;
        // print_r($id);
        
        //This initializes payment and redirects to the payment gateway
        //The initialize method takes the parameter of the redirect URL
        Rave::initialize(route('callback'));
    }
    public function callback() {
        // This verifies the transaction and takes the parameter of the transaction reference
        $data = Rave::verifyTransaction(request()->txref);
        $chargeResponsecode = $data->data->chargecode;
        $chargeAmount = $data->data->amount;
        $chargeCurrency = $data->data->currency;
        $amount = $data->data->amount;
        $currency = "NGN";
        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
        // transaction was successful...
        // please check other things like whether you already gave value for this ref
        // if the email matches the customer who owns the product etc
        //Give Value and return to Success page
            
            return redirect('/success');
        } else {
            //Dont Give Value and return to Failure page
            return redirect('/failed');
        }
            // dd($data);
    }

}
