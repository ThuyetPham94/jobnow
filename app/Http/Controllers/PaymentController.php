<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use App\User;
use Auth;
use App\Repositories\User\UserRepository;

class PaymentController extends Controller
{
    protected $User;
    private $apiContext;
    public function __construct(UserRepository $User){
        //dd();die();
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        
        $this->apiContext->setConfig(config('paypal.settings'));
        $this->User = $User;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$payment_id = Session::get('payment_id');
        //Session::forget('payment_id');
        //dd($request->all());
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        $payment = Payment::get($request->input('paymentId'), $this->apiContext);
        try {
            $result = $payment->execute($execution, $this->apiContext);
            if($result->state == 'approved'){
                $transactions = $result->transactions;
                $data = $transactions[0]->item_list->items[0];
                $credit = 0;
                $input = array();
                if(Auth::user()->IsTrial == 1){
                    $credit == 0;
                    Auth::user()->IsTrial = 0;
                    $input['IsTrial'] = 0;
                }else{
                    $credit = Auth::user()->CreditNumber;                
                }
                if($data->name == 'BASIC'){
                    $credit = $credit + 5;
                }else if($data->name == 'STANDARD'){
                    $credit = $credit + 20;
                }else if($data->name == 'PROFESSIONAL'){
                    $credit = $credit + 50;
                }else if($data->name == 'ENTERPRISE'){
                    $credit = $credit + 100;
                }

                
                $input['CreditNumber'] = $credit;
                $this->User->update(Auth::user()->id,$input);
                Auth::user()->CreditNumber = $credit;
                return redirect()->route('public.company.index');
            }
        } catch (Exception $e) {
            return redirect()->route('public.company.index');
        }       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();        
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        // ### Itemized information
        // (Optional) Lets you specify item wise
        // information
        $item1 = new Item();
        $details = new Details();
        $amount = new Amount();

        if($input['credit'] ==1 ){
            $item1->setName('BASIC')
                ->setCurrency('SGD')
                ->setQuantity(1)
                ->setSku("123123")
                ->setPrice(99);
            $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal(99);
            $amount->setCurrency("SGD")
                ->setTotal(99)
                ->setDetails($details);
        }else if($input['credit'] ==2){
            $item1->setName('STANDARD')
                ->setCurrency('SGD')
                ->setQuantity(1)
                ->setSku("123123")
                ->setPrice(399.8);
            $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal(399.8);
            $amount->setCurrency("SGD")
                ->setTotal(399.8)
                ->setDetails($details);
        }else if($input['credit'] ==3){
            $item1->setName('PROFESSIONAL')
                ->setCurrency('SGD')
                ->setQuantity(1)
                ->setSku("123123")
                ->setPrice(999.5);
            $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal(999.5);
            $amount->setCurrency("SGD")
                ->setTotal(999.5)
                ->setDetails($details);
        }else if($input['credit'] ==4){
            $item1->setName('ENTERPRISE')
                ->setCurrency('SGD')
                ->setQuantity(1)
                ->setSku("123123")
                ->setPrice(1999);
            $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal(1999);
            $amount->setCurrency("SGD")
                ->setTotal(1999)
                ->setDetails($details);
        }        
               
        $itemList = new ItemList();
        $itemList->setItems(array($item1));
        // ### Additional payment details
        // Use this optional field to set additional
        // payment information such as tax, shipping
        // charges etc.
        
        
        // ### Amount
        // Lets you specify a payment amount.
        // You can also specify additional details
        // such as shipping, tax.
        
        
        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        // ### Redirect urls
        // Set the urls that the buyer must be redirected to after 
        // payment approval/ cancellation.
        //$baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.create'))
            ->setCancelUrl(route('payment.create'));
        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent set to 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        // For Sample Purposes Only.
        
        // ### Create Payment
        // Create a payment by calling the 'create' method
        // passing it a valid apiContext.
        // (See bootstrap.php for more on `ApiContext`)
        // The return object contains the state and the
        // url to which the buyer must be redirected to
        // for payment approval
        try {
            $payment->create($this->apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            echo "fail";
            exit(1);
        }
        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $approvalUrl = $payment->getApprovalLink();
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        // echo "<pre>";
        // return $payment;

        Session::put('payment_id',$payment->id);
        return redirect()->to($approvalUrl);
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
