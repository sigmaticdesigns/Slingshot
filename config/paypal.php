<?php
/**
 * Created by PhpStorm.
 * User: esabbath
 * Date: 6/16/16
 * Time: 4:35 PM
 */

return array(
	// set your paypal credential
	'client_id' => env('PAYPAL_CLIENT_ID', 'AWmQUGvwO6yeya37NdiUynWG2KkkcdyiiMmUjqDxLpBHcKBnWtaxseJdqVSdLfcfAE0GOyGiQxUUU7ND'),
	'secret' => env('PAYPAL_SECRET', 'EF3Snn6nLSC-khdjTScWPFPL-9_WxqrLQWx-rptxrNjwToHgn1pe6DtkmFu22FAideJf7yCWdFEgZL8g'),

	/**
	 * SDK configuration
	 */
	'settings' => array(
		/**
		 * Available option 'sandbox' or 'live'
		 */
		'mode' => env('PAYPAL_MODE', 'sandbox'),

		/**
		 * Specify the max request time in seconds
		 */
		'http.ConnectionTimeOut' => 30,

		/**
		 * Whether want to log to a file
		 */
		'log.LogEnabled' => true,

		/**
		 * Specify the file that want to write on
		 */
		'log.FileName' => storage_path() . '/logs/paypal.log',

		/**
		 * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
		 *
		 * Logging is most verbose in the 'FINE' level and decreases as you
		 * proceed towards ERROR
		 */
		'log.LogLevel' => 'FINE'
	),
);
