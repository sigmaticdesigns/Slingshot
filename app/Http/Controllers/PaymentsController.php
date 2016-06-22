<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PaymentRequest;
use App\Payment as PaymentModel;
use App\Project;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaymentsController extends Controller
{
    private $_apiContext;
	protected $user;

	public function __construct(Guard $auth)
    {
	    // setup PayPal api context
	    $paypal_conf = Config::get('paypal');
	    $this->_apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
	    $this->_apiContext->setConfig($paypal_conf['settings']);

	    $this->user = $auth->user();
    }

	public function postPayment(PaymentRequest $request)
	{
		$projectId = $request->input('project_id');
		$project = Project::findOrFail($projectId);

		$userAmount = $request->input('amount');
		$method = $request->input('pay-method', 'paypal');
//		$method = 'paypal';

		$payer = new Payer();
		if ('credit_card' == $method) {
			$card = new CreditCard();
			$card->setType("visa")
				->setNumber("4669424246660779")
				->setExpireMonth("11")
				->setExpireYear("2019")
				->setCvv2("012")
				->setFirstName("Joe")
				->setLastName("Shopper");

			$fi = new FundingInstrument();
			$fi->setCreditCard($card);

			$payer->setPaymentMethod("credit_card")
				->setFundingInstruments([$fi]);
		}
		else {
			$payer->setPaymentMethod('paypal');
		}

		$item = new Item();
		$item->setName($project->name) // item name
		->setCurrency('USD')
			->setQuantity(1)
			->setPrice($userAmount); // unit price

		// add item to list
		$itemList = new ItemList();
		$itemList->setItems(array($item));

		$amount = new Amount();
		$amount->setCurrency('USD')
			->setTotal($userAmount);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription('Backing project:' . $project->name);

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(URL::route('payment.status')) // Specify return URL
		->setCancelUrl(URL::route('payment.status'));

		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

		try {
			$payment->create($this->_apiContext);
		}
		catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Some error occur, sorry for inconvenient');
			}
		}

		if ('credit_card' == $method) {
			return $this->processPayment($payment, $project);
		}

		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());
		Session::put('paypal_payment_project_id', $project->id);

		if(isset($redirect_url)) {
			// redirect to paypal
			if ($request->ajax()) {
				return response()->json(['success' => true, 'redirect' => $redirect_url]);
			}
			return Redirect::away($redirect_url);
		}

		if ('credit_card' == $method) {
			return redirect()->route('payment.status');
		}

		if ($request->ajax()) {
			return response()->json(['success' => false, 'message' => "Unknown error occurred."]);
		}
		return Redirect::route('project.view', $project->id)
			->with('error', 'Unknown error occurred');
	}

	public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$paymentId = Session::get('paypal_payment_id');
		$projectId = Session::get('paypal_payment_project_id');
		// clear the session payment ID
		Session::forget('paypal_payment_id');
		Session::forget('paypal_payment_project_id');

		$project = Project::findOrFail($projectId);

		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			return Redirect::route('projects.show', $project->id)
				->with('error', 'Payment failed');
		}
		$payment = Payment::get($paymentId, $this->_apiContext);
		// PaymentExecution object includes information necessary
		// to execute a PayPal account payment.
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
		//Execute the payment
		$result = $payment->execute($execution, $this->_apiContext);
		return $this->processPayment($result, $project);
	}

	private function processPayment(Payment $payment, Project $project)
	{
		$paymentItem = PaymentModel::create([
			'project_id'    => $project->id,
			'user_id'       => $this->user->id,
			'amount'        => $payment->getTransactions()[0]->getAmount()->getTotal(),
			'method'        => 'paypal',
			'response'      => var_export($payment, true),
		]);

		if ($payment->getState() == 'approved') { // payment made
			$paymentItem->is_paid = 1;
			$paymentItem->save();

			$project->purse = PaymentModel::pursed($project->id);
			$project->save();

			if (request()->ajax()) {
				\Session::flash('success.message', "Thank you! Project has been successfully backed.");
				return response()->json(['success' => true, 'redirect' => route('projects.show', $project->id)]);
			}
			return Redirect::route('projects.show', $project->id)
				->with('success.message', 'Thank you! Project has been successfully backed.');
		}

		if (request()->ajax()) {
			return response()->json(['success' => false, 'message' => "Payment failed."]);
		}
		return Redirect::route('projects.show', $project->id)
			->with('error.message', 'Payment failed');
	}

}
