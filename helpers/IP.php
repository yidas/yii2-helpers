<?php

namespace yidas\helpers;

/**
 * IP Helper for yii2
 * 
 * Real IP getting function including.
 *
 * @author 		Nick Tsai <myintaer@gmail.com>
 * @version 	1.0.1
 * @example
 * 	$ip = \yidas\helpers\IP::get();
 */

class IP
{
	/**
	 * Get real remote IP address
	 *
	 * @return string IP.
	 */
	public static function get()
	{
	    $remoteIP  = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : NULL;

	    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
	    	
	    	return filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP) 
	    		? $_SERVER['HTTP_CLIENT_IP'] 
	    		: $remoteIP;
	    }
	    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

	    	return filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP) 
	    		? $_SERVER['HTTP_X_FORWARDED_FOR'] 
	    		: $remoteIP;
	    }

	    return $remoteIP;
	}
}