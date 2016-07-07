<?php

namespace App\Console;

use App\Mailers\ProjectMailer;
use App\Payment;
use App\Payments\Payout;
use App\Project;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\Sale;
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
		    $mailer = new ProjectMailer();

		    $paypal_conf = Config::get('paypal');
		    $apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		    $apiContext->setConfig($paypal_conf['settings']);

		    /*expire projects*/
		    $projects = Project::active()->where('deadline', '<=', Carbon::now())->get();
		    foreach ($projects as $project)
		    {
			    if ($project->purse >= $project->budget)
			    {
				    $project->status = Project::STATUS_FINISHED;
				    $project->save();
				    /*Project finished*/
				    $user = User::findOrFail($project->user_id);
				    if ($user->paypal_confirmed) {
					    /*send money to project starter*/
					    $payout = new Payout();
					    $payout->sendMoney($user, $project);
				    }
			    }
			    else {
				    $project->status = Project::STATUS_FAILED;
				    $project->save();

				    /*refund money*/
				    $project->payments()->where('is_paid', 1)->update(['status' => Payment::STATUS_DO_REFUND]);
			    }
		    }
		    /*Half deadline*/
		    $projects = Project::active()->where('half_deadline', '<=', Carbon::now())->whereRaw('purse < budget/2')->get();
		    foreach ($projects as $project)
		    {
			    $project->status = Project::STATUS_FAILED;
			    $project->save();

			    /*refund money*/
			    $project->payments()->where('is_paid', 1)->update(['status' => Payment::STATUS_DO_REFUND]);
		    }

		    $payments = Payment::where('status', Payment::STATUS_DO_REFUND)->get();
		    foreach ($payments as $payment)
		    {
			    $amount = new Amount();
			    $amount->setCurrency('USD')
				    ->setTotal($payment->amount);

			    $refund = new Refund();
			    $refund->setAmount($amount);

			    if ($payment->sale_id)
			    {
				    $saleId = $payment->sale_id;
				    $sale = new Sale();
				    $sale->setId($saleId);

				    try {
					    $res = $sale->refund($refund, $apiContext);
				    }
				    catch (PayPalConnectionException $ex) {

				    }
				    if ('completed' == $res->getState())
				    {
					    $payment->status = Payment::STATUS_REFUNDED;
					    $payment->save();
					    /*send email to backer*/
					    $user = User::findOrFail($payment->user_id);
					    $project = Project::findOrFail($payment->project_id);
					    $mailer->sendRefundEmail($user, $project);
				    }
			    }
		    }
	    })->hourly();
    }
}
