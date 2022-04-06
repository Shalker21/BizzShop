<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('site.pages.stripe');
    }

    public function payStripe(Request $request)
    {
        $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $response = \Stripe\Token::create(array(
                "card" => array(
                    "name"      => $request->input('card_name'),
                    "number"    => $request->input('card_no'),
                    "exp_month" => $request->input('expiry_month'),
                    "exp_year"  => $request->input('expiry_year'),
                    "cvc"       => $request->input('cvv')
                )));

            if (!isset($response['id'])) {
                dd("NEMA ID POSTALJEN");
            }
            $charge = \Stripe\Charge::create([
                'card' => $response['id'],
                'currency' => 'USD',
                'amount' =>  (float)$request->total,
                'description' => 'TESTING PAYMENT',
            ]);
 
            if($charge['status'] == 'succeeded') {

                return view('site.pages.success_payment', ['email' => "TEST EMAIL"]);
 
            } else {
                dd('OPET NEKI KURAC KRIVO!');
            }
 
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
 
    }

}
