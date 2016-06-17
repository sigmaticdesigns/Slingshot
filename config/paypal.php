<?php
/**
 * Created by PhpStorm.
 * User: esabbath
 * Date: 6/16/16
 * Time: 4:35 PM
 */

return array(
	// set your paypal credential
	'client_id' => env('PAYPAL_CLIENT_ID', 'AQwg27anqI-eC0pZJ2SeI0Ig0IYWzORL6nBXoGi6tJOI9YMr72hM5i5AoOotTYgV8pdmP4QdZITwlAFD'),
	'secret' => env('PAYPAL_SECRET', 'EJjYxmLT9nXNz3-24DGkIb_wL6B4aVng_ScxgIVrZ7R4Qrb_e84Tm1ftmzpiXCjIphu4P9qrBiicL1bw'),

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
