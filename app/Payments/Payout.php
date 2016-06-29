<?php
/**
 * Created by PhpStorm.
 * User: esabbath
 * Date: 6/28/16
 * Time: 7:15 PM
 */

namespace App\Payments;


use App\Project;
use App\User;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Currency;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;

class Payout
{
	private $_apiContext;

	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = Config::get('paypal');
		$this->_apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_apiContext->setConfig($paypal_conf['settings']);
	}

	public function sendMoney(User $user, Project $project)
	{
		$payout = new \PayPal\Api\Payout();

		$senderBatchHeader = new PayoutSenderBatchHeader();

		$senderBatchHeader->setSenderBatchId(uniqid())
			->setEmailSubject("You have a Payout!");

		$currency = new Currency();
		$currency->setCurrency('USD')
			->setValue($project->budget);


		// #### Sender Item
		// Please note that if you are using single payout with sync mode, you can only pass one Item in the request
		$senderItem = new PayoutItem();
		$senderItem->setRecipientType('Email')
			->setNote('Thanks for your patronage!')
			->setReceiver($user->email)
			->setSenderItemId($project->id)
			->setAmount($currency);
		$payout->setSenderBatchHeader($senderBatchHeader)
			->addItem($senderItem);
// For Sample Purposes Only.
		$request = clone $payout;
// ### Create Payout
		try {
			$output = $payout->createSynchronous($this->_apiContext);
		} catch (Exception $ex) {
			// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
			ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
			exit(1);
		}
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
		ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
		return $output;
	}
}