<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\executePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
  

   public function checkOut(){
    return view('checkout');
   }

   public function postPayment(Request $request)
   {
       $payer = new Payer();
       $payer->setPaymentMethod('paypal');
       $username = $request->get('name');
       $money = $request->get('amount');
       $currency = env('PAYPAL_CURRENCY');
   
       $item = new Item();
       $item->setName($username)->setCurrency($currency)->setQuantity(1)->setPrice($money);
   
       $itemList = new ItemList();
       $itemList->setItems([$item]);
   
       $details = new Details();
       $details->setShipping(0.00)
               ->setTax(0.00)
               ->setSubtotal(10.00);
   
       $amount = new Amount();
       $amount->setCurrency($currency)
              ->setTotal($money)
              ->setDetails($details);
   
       $transaction = new Transaction();
       $transaction->setAmount($amount)
                   ->setItemList($itemList)
                   ->setDescription('Test Transaction')
                   ->setInvoiceNumber(uniqid());
   
       $redirectUrls = new RedirectUrls();
       $redirectUrls->setReturnUrl(route('homepage'))
                    ->setCancelUrl(route('cart.show'));
   
       $payment = new Payment();
       $payment->setIntent('sale')
               ->setPayer($payer)
               ->setRedirectUrls($redirectUrls)
               ->setTransactions([$transaction]);
   
       try {
           $payment->create($this->_api_context);
       } catch(\PayPal\Exception\PPConnectionException $ex) {
           return $ex;
       }
   
       // Get payment ID from PayPal API
       $payment_id = $payment->getId();
   
       // Get redirect URLs from PayPal API
       $redirectUrls = $payment->getRedirectUrls();
   
       // Store payment ID in session for later use
       Session::put('paypal_payment_id', $payment_id);
   
       // If there are no redirect URLs, return error
       if (!$redirectUrls) {
           return redirect()->route('cart.show')->with('error', 'Failed to create payment');
       }
   
       // Redirect user to PayPal for payment
       return Redirect::away($redirectUrls->getApprovalUrl());
   }
   

   public function getPaymentStatus(Request $request)
   {
        // Get payment ID from session
        $payment_id = Session::get('paypal_payment_id');

        // Clear the session payment ID
   }
}