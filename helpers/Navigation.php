<?php

namespace yidas\helpers;

/**
 * Navigation Helper for yii2
 * 
 * Web locator saving location and providing validation.
 *
 * @author 		Nick Tsai <myintaer@gmail.com>
 * @version 	1.0.0
 * @example
 * 	\yidas\helpers\Navigation::set('site/index');	// Set location
 * 	\yidas\helpers\Navigation::in('site/');			// True for site/*
 * 	\yidas\helpers\Navigation::is('site/index');	// True for site/index
 */

class Navigation
{
	/**
	 * @var string $lcoation Current location
	 */
	public static $location;

	/**
	 * @var string $separator Default separator
	 */
	public static $separator = '/';

	/**
	 * Get location method
	 *
     * @return string Current location
	 */
	public static function get()
	{
		return self::$location;
	}

	/**
	 * Set location method
	 *
	 * @param string $value Current location
	 */
	public static function set($value)
	{
		self::$location = $value;
	}

	/**
	 * Add location method
	 *
	 * @param string $value Current location
	 */
	public static function add($value)
	{
		self::$location .= self::$separator . $value;
	}

	/**
     * Validate current location is completely matched target location or not
     *
     * @param string $location Target location
     * @return boolean
     */
    public static function is($location)
    {
        return self::$location==$location ? true : false;
    }

    /**
     * Validate current location is under target location or not
     *
     * @param string $location Target location
     * @return boolean
     */
    public static function in($location)
    {
        return strpos(self::$location, $location)===0 ? true : false;
    }
}