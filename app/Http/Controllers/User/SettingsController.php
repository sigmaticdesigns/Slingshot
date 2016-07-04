<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\LinksRequest;
use App\Mailers\AppMailer;
use App\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class SettingsController extends Controller
{
	protected $user;

	public function __construct(Guard $auth)
	{
		$this->user = $auth->user();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $user = User::findOrFail($this->user->id);
        return view('user.settings.index', compact('user'));
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
    public function postUpdate(Request $request)
    {
        $user = User::findOrFail($this->user->id);
	    if (\Input::hasFile('avatar'))
		{
		    $user->deleteImage();

		    $image = Input::file('avatar');
		    $filenameBig = $user->id. '_300' . '.'. $image->getClientOriginalExtension();
		    $filenameSmall = $user->id . '_28' . '.'. $image->getClientOriginalExtension();

			$publicDirName = '/static/uploads/avatar/' . date("Y") . '/' . date("m"). '/'. date("d");
			$dirName = public_path($publicDirName);
			if (!\Illuminate\Support\Facades\File::exists($dirName)) {
				\Illuminate\Support\Facades\File::makeDirectory($dirName, 0755, true);
			}

			$pathBig = $dirName . '/' . $filenameBig;
			$pathSmall = $dirName . '/' . $filenameSmall;

//		    TODO: do crop
		    \Image::make($image->getRealPath())->fit(258, 258)->save($pathBig);
		    \Image::make($image->getRealPath())->fit(28, 28)->save($pathSmall);
		    $user->avatar = json_encode(
				[
					'path'	=> $publicDirName,
					's'		=> $filenameSmall,
					'b'		=> $filenameBig
				]
			);
		    $user->save();
		    \Session::flash('success.message', "Your profile picture has been successfully updated.");
		    if ($request->ajax()) {
			    return response()->json(['success' => true, 'redirect' => url('user/settings')]);
		    }
	    }
	    else {
		    $user->update($request->all());
	    }

	    \Session::flash('success.message', "Your Settings has been successfully updated.");
	    if ($request->ajax()) {
		    return response()->json(['success' => true, 'redirect' => url('user/settings')]);
	    }
	    else {
		    return redirect()->back()->withInput();
	    }
    }

	public function getChangePassword()
	{
		return view('user.settings.password');
	}

	public function postChangePassword(Request $request)
	{
		$this->validate($request, [
			'old_password' => 'required',
			'password' => 'required|confirmed|min:6',
		]);

		$data = $request->all();
		if (!Hash::check($data['old_password'], $this->user->password)) {
			if ($request->ajax()) {
				return response()->json(['old_password' => ['Incorrect password.']], 422);
			}
			else {
				return redirect()->back()->withErrors(['old_password' => 'Wrong password.']);
			}
		}

		$this->user->password = $data['password'];
		$this->user->save();

		\Session::flash('success.message', "Your password has been successfully changed.");
		if ($request->ajax()) {
			return response()->json(['success' => true, 'redirect' => url('user/settings')]);
		}
		return redirect()->back();

	}

	public function getAboutMe()
	{
		return view('user.settings.about');
	}

	public function getAvatar()
	{
		return view('user.settings.avatar');
	}

	public function getLinks()
	{
		return view('user.settings.links');
	}

	public function postLinks(LinksRequest $request)
	{
		$link = $request->input('link');
		$user = User::findOrFail($this->user->id);
		$links = $user->links;
		$links[] = $link;
		$user->links = $links;
		$user->save();
		\Session::flash('success.message', "Your Settings has been successfully updated.");
		if ($request->ajax()) {
			return response()->json(['success' => true, 'redirect' => url('user/settings')]);
		}
	}

	public function getConfirmEmail(AppMailer $mailer)
	{
		$mailer->sendEmailConfirmationTo(User::findOrFail($this->user->id));
		if (request()->ajax()) {
			return response()->json(['success' => true, 'message' => 'Verification email has been send']);
		}
	}

	public function getConfirmPaypal()
	{
		// setup PayPal api context
		$paypal_conf = Config::get('paypal');
		$apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$apiContext->setConfig($paypal_conf['settings']);

		$userAmount = .1;

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$amount = new Amount();
		$amount->setCurrency('USD')
			->setTotal($userAmount);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setDescription('PayPal Account confirmation');

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(url('user/settings/payment-status')) // Specify return URL
		->setCancelUrl(url('user/settings/payment-status'));

		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

		try {
			$payment->create($apiContext);
		}
		catch (PayPalConnectionException $ex)
		{
			return redirect()->back()->withErrors(['error.message' => $ex->getMessage()]);
		}

		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());

		if(isset($redirect_url)) {
			return Redirect::away($redirect_url);
		}

		return Redirect::back()
			->with('error.message', 'Unknown error occurred');
	}

	public function getPaymentStatus()
	{
		// setup PayPal api context
		$paypal_conf = Config::get('paypal');
		$apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$apiContext->setConfig($paypal_conf['settings']);

		// Get the payment ID before session clear
		$paymentId = Session::get('paypal_payment_id');
		// clear the session payment ID
		Session::forget('paypal_payment_id');

		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			return redirect()->action('User\SettingsController@index')
				->with('error', 'Payment failed');
		}

		$payment = Payment::get($paymentId, $apiContext);
		// PaymentExecution object includes information necessary
		// to execute a PayPal account payment.
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
		//Execute the payment
		try {
			$payment = $payment->execute($execution, $apiContext);
		}
		catch (PayPalConnectionException $ex) {

		}

		if ($payment->getState() == 'approved') { // payment made
			$payPalEmail = $payment->getPayer()->getPayerInfo()->getEmail();
			if ($this->user->email == $payPalEmail) {
				$user = User::findOrFail($this->user->id);
				$user->paypal_confirmed = true;
				$user->save();
				\Session::flash('success.message', 'Thank you! PayPal account is confirmed');
			}
			else {
				\Session::flash('error.message', 'Email doesn\'t match.');
			}
			return redirect()->action('User\SettingsController@index');
		}

		return redirect()->action('User\SettingsController@index')
			->with('error.message', 'Payment failed');
	}


}
