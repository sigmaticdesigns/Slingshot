<?php
/**
 * Created by PhpStorm.
 * User: esabbath
 * Date: 7/4/16
 * Time: 12:25 PM
 */

namespace App\Mailers;


use App\Letter;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class ProjectMailer
{
	/**
	 * The sender of the email.
	 *
	 * @var string
	 */
	protected $from = ['address' => 'admin@example.com', 'name' => 'Admin'];

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
	public function __construct()
	{
		$this->from = Config::get('mail.from');
	}

	public function sendRefundEmail(User $user, Project $project) {
		$slug = 'project-failed';
		$this->sendEmailTo($user, $project, $slug);
	}

	public function sendSuccessEmail(User $user, Project $project) {
		$slug = 'project-finished';
		$this->sendEmailTo($user, $project, $slug);
	}

	public function sendEmailTo(User $user, Project $project, $slug)
	{
		$letter = Letter::where('slug', $slug)->firstOrFail();
		$messageContent = $this->parseMessageData($letter, $user, $project);

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
		Mail::queue($this->view, $this->data, function ($message) {
			$message->from($this->from['address'], $this->from['name'])
				->subject($this->subject)
				->to($this->to);
		});
	}

	private function parseMessageData($letter, $userData, Project $project)
	{
		$vars = [
			'{name}' 			    => $userData->name,
			'{email}' 				=> $userData->email,
			'{project_name}'        => $project->name,
			'{project_link}'        => route('projects.show', $project->id),
			'{login_link}'	        => url('/auth/login'),
		];
		$result = str_replace(array_keys($vars), $vars, $letter->content);
		return $result;
	}
}