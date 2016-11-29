<?php

namespace yidas\helpers;

/**
 * Route Helper for yii2
 * 
 * Providing route information and validation.
 *
 * @author      Nick Tsai <myintaer@gmail.com>
 * @version     1.2.0
 * @example
 *  Route::in('site');          // True for site/*
 *  Route::is('site/index');    // True for site/index
 *  Route::get();               // Get such as 'site/index'
 *  Route::getByLevel(1);       // Get 'site' from 'site/index'
 *
 *  // Root Level usage for filtering prefix from route
 *  Route::setRootLevel(1);     // Set the rootLevel to 1
 *  Route::get();               // Get 'index' from 'site/index' 
 *  Route::setRootLevel();      // Get the rootLevel back to 0
 *  Route::get();               // Get 'site/index' from 'site/index'
 *
 */

use Yii;

class Route
{
    /**
     * @var string $routeCache
     */
    private static $routeCache;

    /**
     * @var int $rootLevel
     */
    private static $rootLevel = 0;

    /**
     * Get route
     *
     * @return string Current route of Yii
     */
    public static function get()
    {
        // If there is no cahce, build a new one
        if (!self::$routeCache) {
            
            self::$routeCache = Yii::$app->controller->getRoute();

            if (self::$rootLevel) {
                
                if (self::$rootLevel==1) {
                    
                    self::$routeCache = substr(self::$routeCache, strpos(self::$routeCache, '/')+1);

                } else {

                    self::$routeCache = substr(self::$routeCache, strlen(self::getByLevel(self::$rootLevel))+1);
                }
            }
        }

        return self::$routeCache;
    }

    /**
     * Set $rootLevel
     *
     * @param int $level
     */
    public static function setRootLevel($level=0)
    {
        self::$rootLevel = (int) $level;

        // Clear cache
        self::$routeCache = NULL;
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
        $route = is_string($route) ? $route : NULL;

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
        $route = is_string($route) ? $route : NULL;

        return strpos(self::get(), $route)===0 ? true : false;
    }

    /**
     * Validate current route is included in target route or not
     *
     * @param string $route Target route
     * @return boolean
     */
    public static function match($route)
    {
        $route = is_string($route) ? $route : NULL;

        return strpos(self::get(), $route)!==false ? true : false;
    }
}