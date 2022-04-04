<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use Stripe;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        if (!session()->get('cart')) {
            abort(404);   
        }
        return view('site.pages.checkout');
    }

    public function success_order()
    {
        $email = session('order_email');
        session()->forget('order_email');

        return view('site.pages.success_payment', ['email' => $email]);
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_number' => 'required',
            'phone_number' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->payment_method === 'card_payment') {

            $this->validate($request, [
                
                'card_no' => 'required',
                
                'expiry_month' => 'required',
                
                'expiry_year' => 'required',
                
                'cvv' => 'required',
            
            ]);
            
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
                
                    abort(404);
                
                }

                $charge = \Stripe\Charge::create([
                
                    'card' => $response['id'],
                
                    'currency' => 'USD',
                
                    'amount' =>  (float)$request->total * 100,
                
                    'description' => 'TESTING PAYMENT',
                
                ]);
    
                if($charge['status'] == 'succeeded') {

                    $order = $this->orderRepository->storeOrderDetails($request->all());
    
                }
    
            }
            catch (\Exception $e) {

                return $e->getMessage();
            
            }
        
        } else {

            $order = $this->orderRepository->storeOrderDetails($request->all());
        
        }


        if (!$order) {

            abort(404);
        
        }

        session()->put('order_email', $request->email);

        return redirect()->route('product.successOrder');
    }
}
