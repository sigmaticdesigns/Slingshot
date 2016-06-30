<?php
/**
 * Created by PhpStorm.
 * User: esabbath
 * Date: 6/28/16
 * Time: 10:58 AM
 */

namespace App\Mailers;


use App\Letter;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Config;

class AppMailer
{

	/**
	 * The Laravel Mailer instance.
	 *
	 * @var Mailer
	 */
	protected $mailer;

	/**
	 * The sender of the email.
	 *
	 * @var string
	 */
	protected $from = 'admin@example.com';

	/**
	 * The recipient of the email.
	 *
	 * @var string
	 */
	protected $to;

	/**
	 * The view for the email.
	 *
	 * @var string
	 */
	protected $view;

	/**
	 * The data associated with the view for the email.
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * The email subject
	 *
	 * @var string
	 */
	protected $subject;

	/**
	 * Create a new app mailer instance.
	 *
	 * @param Mailer $mailer
	 */
	public function __construct(Mailer $mailer)
	{
		$this->mailer = $mailer;
		$this->from = Config::get('mail.from');
	}

	/**
	 * Deliver the email confirmation.
	 *
	 * @param  User $user
	 * @return void
	 */
	public function sendEmailConfirmationTo(User $user)
	{
		$letter = Letter::where('slug', 'email-confirm')->firstOrFail();
		$messageContent = $this->parseMessageData($letter, $user);

		$this->subject = $letter->subject;
		$this->to = $user->email;
		$this->view = 'emails.template';
		$this->data = compact('user', 'messageContent', 'letter');

		$this->deliver();
	}

	public function sendEmailTo(User $user, $slug)
	{
		$letter = Letter::where('slug', $slug)->firstOrFail();
		$messageContent = $this->parseMessageData($letter, $user);

		$this->subject = $letter->subject;
		$this->to = $user->email;
		$this->view = 'emails.template';
		$this->data = compact('user', 'messageContent', 'letter');

		$this->deliver();
	}

	/**
	 * Deliver the email.
	 *
	 * @return void
	 */
	public function deliver()
	{
		$this->mailer->send($this->view, $this->data, function ($message) {
			$message->from($this->from['address'], $this->from['name'])
				->subject($this->subject)
				->to($this->to);
		});
	}

	private function parseMessageData($letter, $userData)
	{
		$vars = [
			'{name}' 			    => $userData->name,
			'{email}' 				=> $userData->email,
			'{login_link}'	        => url('/auth/login'),
			'{email_verify_link}'   => url("email/confirm/{$userData->token}")
		];
		$result = str_replace(array_keys($vars), $vars, $letter->content);
		return $result;
	}
}
