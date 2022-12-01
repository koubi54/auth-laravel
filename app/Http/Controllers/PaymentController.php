<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Omnipay\Omnipay;
class PaymentController extends Controller
{
   
    private $gateway;
   
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AcGQHcwCHv4Yvm3V_iptZQvEu6GYbb4ufdb4u-o9oODWekGBOxApiLzyUv84KX3PVExvAHbB7878a8tZ');
        $this->gateway->setSecret('EM_j7kYJN0wDdLZpuLP0GCViAnWSK2bWS0-gFt-4kTfH_InL2E2lKQIZqlybrizujhKghgYWVA6GwoEE_3Q');
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
   
    /**
     * Call a view.
     */
    public function index()
    {
        return view('payment');
    }
   
    /**
     * Initiate a payment on PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function charge(Request $request)
    {
        try {
            $response = $this->gateway->purchase(array(
                'amount' => 224,
                'currency' => 'MAD',
                'returnUrl' => route('success.payment'),
                'cancelUrl' => route('error.payment'),
            ))->send();
        
            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
   
    /**
     * Charge a payment and store the transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
           
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
           
                // Insert transaction data into the database
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();
           
                return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }
   
    /**
     * Error Handling.
     */
    public function errorPYP()
    {
        return 'User cancelled the payment.';
    }
}