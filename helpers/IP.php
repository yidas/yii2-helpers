<?php

namespace yidas\helpers;

/**
 * IP Helper for yii2
 * 
 * This helper will get the remote IP address by setting directly access or 
 * proxy access, to prevent client header modified attack.
 *
 * @author 		Nick Tsai <myintaer@gmail.com>
 * @version 	2.0.0
 * @example
 * 	$ip = IP::getRemoteIP();
 * 	$ip = IP::get();						// Alias funciton call
 *
 *  $ip = IP::setUseProxy(true);
 * 	$ip = IP::get();						// Forwarded IP if exist
 * 	$ip = IP::setUseProxy(false)->get(); 	// $_SERVER['REMOTE_ADDR']
 *  $ip = IP::setUseProxy()->get();			// Forwarded IP if exist
 */

class IP
{
	/**
	 * @var $useProxy Proxy flag switch
	 *
	 * Turn this on when your server is under load balancer or proxy.
	 */
	public static $useProxy = false;

	/**
	 * @var $cachedIP IP cache
	 */
	private static $cachedIP;

	/**
	 * Set $useProxy
	 *
	 * @param bool $value
	 * @return Object Self
	 */
	public static function setUseProxy($value=true)
	{
		self::$useProxy = $value;

		// Clear cachedIP
		unset(self::$cachedIP);

		return new self;
	}

	/**
	 * Get real remote IP address
	 *
	 * @return string IP.
	 */
	public static function getRemoteIP()
	{
		// Check cache
		if (self::$cachedIP) {
			
			return self::$cachedIP;
		}

		$remoteAddr = (isset($_SERVER['REMOTE_ADDR']))
			? $_SERVER['REMOTE_ADDR']
			: NULL;

		// No proxy or load balancer
		if (!self::$useProxy) {
			
			return self::$cachedIP = $remoteAddr;
		}

	    /**
	     * Get Real IP from Proxy / Load Balancer
	     */
	    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
	    	
	    	return self::$cachedIP = $_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

	    	return self::$cachedIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }

	    return self::$cachedIP = $remoteAddr;
	}

	/**
	 * Alias of getRemoteIP()
	 *
	 * @see getRemoteIP()
	 */
	public static function get()
	{
		return self::getRemoteIP();
	}

	/**
	 * Alias of getRemoteIP()
	 *
	 * @see getRemoteIP()
	 */
	public static function getClientIP()
	{
		return self::getRemoteIP();
	}

	/**
	 * Alias of getRemoteIP()
	 *
	 * @see getRemoteIP()
	 */
	public static function getRealIP()
	{
		return self::getRemoteIP();
	}

	/**
	 * Get IP headers for debug
	 *
	 * @return array IP Header array
	 */
	public static function getIpHeaders()
	{
		$headerKeys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
            'HTTP_VIA'
            ];

        $ipHeaderArray = [];

        foreach ($headerKeys as $key => $serverKey) {
            
            $ipHeaderArray[$serverKey] = (isset($_SERVER[$serverKey]))
                ? $_SERVER[$serverKey]
                : NULL;
        }

		return $ipHeaderArray;
	}
}