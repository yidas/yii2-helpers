<?php

namespace yidas\helpers;

/**
 * Route Helper for yii2
 * 
 * Providing route information and validation.
 *
 * @author 		Nick Tsai <myintaer@gmail.com>
 * @version 	1.0.0
 * @example
 * 	\yidas\helpers\Route::in('site');		// True for site/*
 * 	\yidas\helpers\Route::is('site/index');	// True for site/index
 */

use Yii;

class Route
{
	/**
	 * Get route
	 *
	 * @return string Current route of Yii
	 */
	public static function get()
	{
		return Yii::$app->controller->getRoute();
	}

	/**
     * Validate current route is completely matched target route or not
     *
     * @param string $route Target route
     * @return boolean
     */
    public static function is($route) {

        return self::get()==$route ? true : false;
    }

    /**
     * Validate current route is under target route or not
     *
     * @param string $route Target route
     * @return boolean
     */
    public static function in($route) {

        return strpos(self::get(), $route)===0 ? true : false;
    }
}