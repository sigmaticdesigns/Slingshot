<?php

namespace App\Console;

use App\Payment;
use App\Project;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

	    $schedule->call(function ()
	    {
		    $paypal_conf = Config::get('paypal');
		    $apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		    $apiContext->setConfig($paypal_conf['settings']);

		    /*expire projects*/
		    $projects = Project::active()->where('deadline', '>=', Carbon::now())->get();
		    foreach ($projects as $project)
		    {
			    if ($project->purse >= $project->budget)
			    {
				    $project->status = Project::STATUS_FINISHED;
				    $project->save();
			    }
			    else {
				    $project->status = Project::STATUS_FAILED;
				    $project->save();

				    /*refund money*/
				    $project->payments()->update(['status' => Payment::STATUS_DO_REFUND]);
			    }
		    }

		    $payments = Payment::where('status', Payment::STATUS_DO_REFUND)->get();
		    foreach ($payments as $payment)
		    {
			    $amount = new Amount();
			    $amount->setCurrency('USD')
				    ->setTotal($payment->amount);

			    $refund = new Refund();
			    $refund->setAmount($amount);

			    if ($payment->sale_id) {
				    $saleId = $payment->sale_id;
				    $sale = new Sale();
				    $sale->setId($saleId);

				    try {
					    $res = $sale->refund($refund, $apiContext);
				    }
				    catch (PayPalConnectionException $ex) {

				    }
				    if ('completed' == $res->getState()) {
					    $payment->status = Payment::STATUS_REFUNDED;
					    $payment->save();
				    }
			    }
		    }
	    })->hourly();
    }
}
