<?php

namespace yidas\helpers;

/**
 * JS Route Helper for yii2
 * 
 * Redirector by JS base calling in Controller
 *
 * @author 		Nick Tsai <myintaer@gmail.com>
 * @version 	1.0.0
 * @example
 * 	RouteJS::redirect(['index', 'status'=>'1'], 'Success!');
 * 	RouteJS::goBack('Go back success!');
 */

use yii\helpers\Url;

class RouteJS
{
	/**
	 * Redirect to the specified route with optional alert() function
	 *
	 * @param mixed $route Yii's route name by \yii\helpers\Url::to().
	 * @param string $alertMsg Showing JS alert message if needed.
	 */
	public static function to($route=NULL, $alertMsg=NULL)
	{
		$jsAlert = isset($alertMsg) ? "alert('{$alertMsg}');" : '';

		echo "<script>{$jsAlert}location.href='".Url::to($route)."';</script>";
	}

	/**
	 * Alias of self::to()
	 */
	public static function redirect($route=NULL, $alertMsg=NULL)
	{
		self::to($route, $alertMsg);
	}

	/**
	 * History back
	 *
	 * @param string $alertMsg Showing JS alert message if needed.
	 */
	public static function goBack($alertMsg=NULL)
	{
		$jsAlert = isset($alertMsg) ? "alert('{$alertMsg}');" : '';

		echo "<script>{$jsAlert}history.back();</script>";
	}
}