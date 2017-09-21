<?php 
namespace App\Http\Controllers;
use Paypalpayment;
use App\Models\AcPago;
use Illuminate\Http\Request;
class PaypalPaymentController extends Controller {

    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;

    public function index()
    {
        echo "<pre>";
        
        $payments = Paypalpayment::getAll(array('count' => 1, 'start_index' => 0), $this->_apiContext);
        
        dd($payments);
    }
    
    public function __construct()
    {

        
        $this->_apiContext = Paypalpayment::ApiContext(config('paypal_payment.Account.ClientId'), config('paypal_payment.Account.ClientSecret'));

    }
    
    
    public function create()
    {
        return View::make('payment.order');
    }
    
    /*
     * Process payment using credit card
     */
    public function store(Request $request)
    {
       // dd($request->creditCardNumber);
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
       /* $addr= Paypalpayment::address();
        $addr->setLine1("3909 Witmer Road");
        $addr->setLine2("Niagara Falls");
        $addr->setCity("Niagara Falls");
        $addr->setState("NY");
        $addr->setPostalCode("14305");
        $addr->setCountryCode("US");
        $addr->setPhone("716-298-1822");*/
        
        // ### CreditCard
        if($request!="")
        {
            $card = Paypalpayment::creditCard();
            $card->setType($request->creditCardType)
            ->setNumber($request->creditCardNumber)
            ->setExpireMonth($request->expDateMonth)
            ->setExpireYear($request->expDateYear)
            ->setCvv2($request->ccv2Number)
            ->setFirstName($request->firstName)
            ->setLastName($request->firstName);
            
            // ### FundingInstrument
            // A resource representing a Payer's funding instrument.
            // Use a Payer ID (A unique identifier of the payer generated
            // and provided by the facilitator. This is required when
            // creating or using a tokenized funding instrument)
            // and the `CreditCardDetails`
            $fi = Paypalpayment::fundingInstrument();
            $fi->setCreditCard($card);
            
            // ### Payer
            // A resource representing a Payer that funds a payment
            // Use the List of `FundingInstrument` and the Payment Method
            // as 'credit_card'
            $payer = Paypalpayment::payer();
            $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));
            
            $item1 = Paypalpayment::item();
            $item1->setName('Ground Coffee 40 oz')
            ->setDescription('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setTax(0.0)
            ->setPrice($request->monto);
            
            
            
            $itemList = Paypalpayment::itemList();
            $itemList->setItems(array($item1));
            
            
            $details = Paypalpayment::details();
            $details->setShipping("0.0")
            ->setTax("0.0")
            //total of items prices
            ->setSubtotal($request->monto);
            
            //Payment Amount
            $amount = Paypalpayment::amount();
            $amount->setCurrency("USD")
            // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
            ->setTotal($request->monto)
            ->setDetails($details);
            
            // ### Transaction
            // A transaction defines the contract of a
            // payment - what is the payment for and who
            // is fulfilling it. Transaction is created with
            // a `Payee` and `Amount` types
            
            $transaction = Paypalpayment::transaction();
            $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
            
            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent as 'sale'
            
            $payment = Paypalpayment::payment();
            
            $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));
            
            try {
                // ### Create Payment
                // Create a payment by posting to the APIService
                // using a valid ApiContext
                // The return object contains the status;
                $payment->create($this->_apiContext);
            } catch (\PPConnectionException $ex) {
                
                echo "aqui";die();
                return  "Exception: " . $ex->getMessage() . PHP_EOL;
                exit(1);
            }
            if($payment->state==null)
            {
                //echo "aqui";die();
            }
                 //var_dump($payment->state);die();
            $estado = $payment->state;
            if($estado=="approved")
            {
                $response["pagoexitoso"]= true; 
                $pagos = explode("|",$request->idpago);
               
                $cantPagos=count($pagos);
                for($i=1;$i<$cantPagos;$i++)
                {
                   // dd($pagos[$i]);
                    $oPago= AcPago::findOrFail($pagos[$i]);
                    $oPago->estatuspago = "2";
                    $oPago->observacion = "Pago realizado con exito";
                    $oPago->fechapago = \date("Y-m-d");
                    $oPago->hora= \date('H:i');
                    $res = $oPago->save();
                   // dd($res);
                }
                
                return view("recarga.respuestapago");
            }
            elseif($payment->state==null)
            {
                return view("recarga.respuestapagoerror");
            }
        }
    } 
     
}

?>