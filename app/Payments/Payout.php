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
	}

	public function sendMoney(User $user, Project $project)
	{

	}
}