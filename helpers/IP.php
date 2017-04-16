<?php

namespace yidas\helpers;

/**
 * IP Helper for yii2
 * 
 * Real IP getting function including.
 *
 * @author 		Nick Tsai <myintaer@gmail.com>
 * @version 	1.0.0
 * @example
 * 	$ip = \yidas\helpers\IP::get();
 */

use yii\helpers\Url;

class IP
{
	/**
	 * Get real remote IP address
	 *
	 * @return string IP.
	 */
	public static function get()
	{
		$clientIP  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forwardIP = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remoteIP  = $_SERVER['REMOTE_ADDR'];

	    if (filter_var($clientIP, FILTER_VALIDATE_IP)) {
	    	
	    	return $clientIP;
	    } 
	    elseif (filter_var($forwardIP, FILTER_VALIDATE_IP)) {
	    	
	    	return $forwardIP;
	    } 

	    return $remoteIP;
	}
}