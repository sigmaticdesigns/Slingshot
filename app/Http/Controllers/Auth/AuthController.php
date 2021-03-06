<?php

namespace App\Http\Controllers\Auth;

use App\Mailers\AppMailer;
use App\User;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $redirectPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request, AppMailer $mailer)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails()) {
			$this->throwValidationException(
				$request, $validator
			);
		}

		$user = $this->create($request->all());
		Auth::login($user);

		$user->token = str_random(30);
		$user->save();
		$mailer->sendEmailTo($user, 'registration-email');
		\Session::flash('success.message', 'Please confirm your email address.');


		return redirect($this->redirectPath());
	}


	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		if (view()->exists('auth.authenticate')) {
			return view('auth.authenticate');
		}

		$redirectTo = Input::get('redirect_to', null);

		return view('auth.login')->with('redirectTo', $redirectTo);
	}

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();


		if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }


        if (Input::has('redirect_to')) {
	        $this->redirectPath = Input::get('redirect_to');
        }

	    $credentials = $this->getCredentials($request);

		$credentials['status'] = User::STATUS_ACTIVE;

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

//		TODO: return correct response for banned user
		$user = User::where('email', $credentials['email'])->first();
		if ($user && User::STATUS_BANNED == $user->status) {
			$error =[$this->loginUsername() => 'Sorry you are banned!'];
		}
		else {
			$error =[
				$this->loginUsername() => $this->getFailedLoginMessage(),
			];
		}

		return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors($error);
    }
}
