<?php

namespace yidas\helpers;

/**
 * Route Helper for yii2
 * 
 * Providing route information and validation.
 *
 * @author      Nick Tsai <myintaer@gmail.com>
 * @version     1.1.0
 * @example
 *  Route::in('site');          // True for site/*
 *  Route::is('site/index');    // True for site/index
 *  Route::get();               // get such as 'site/index'
 *  Route::getByLevel(1);       // get 'site' from 'site/index'
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
     * Get route splitting from specified level
     *
     * @param int $level Route level separated by slash
     * @return string
     */
    public static function getByLevel($level=1)
    {
        $routeArray = explode('/', self::get());

        $maxLevel = count($routeArray);

        $level = $level>=1 && $level<=$maxLevel ? (int)$level : $maxLevel;

        array_splice($routeArray, $level);

        return implode('/', $routeArray);
    }

    /**
     * Validate current route is completely matched target route or not
     *
     * @param string $route Target route
     * @return boolean
     */
    public static function is($route)
    {
        return self::get()==$route ? true : false;
    }

    /**
     * Validate current route is under target route or not
     *
     * @param string $route Target route
     * @return boolean
     */
    public static function in($route)
    {
        return strpos(self::get(), $route)===0 ? true : false;
    }
}