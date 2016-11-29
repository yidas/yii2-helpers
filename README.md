# yii2-helpers

Collection of useful helpers for Yii Framework 2.0

---

## Installation

In yii2 composer.json, additional require yidas/yii2-helpers.
```
"require": {
        ...
        "yidas/yii2-helpers": "*"
    },
```

Or, install from composer command:
```
$ php composer.phar require yidas/yii2-helpers
```

---

## Helper list

- ####`Navigation`  
  Web locator saving location and providing validation.

- ####`Route`  
  Providing route information and validation.

- ####`RouteJS`  
  Redirector by JS base calling in Controller
  
---

## Helper: Route

Usage: (Supposing the current controller route is 'site/index')

```
Route::in('site');          // True for site/*
Route::is('site/index');    // True for site/index
Route::get();               // Get such as 'site/index'
Route::getByLevel(1);       // Get 'site' from 'site/index'

// Root Level usage for filtering prefix from route
Route::setRootLevel(1);     // Set the rootLevel to 1
Route::get();               // Get 'index' from 'site/index' 
Route::setRootLevel();      // Get the rootLevel back to 0
Route::get();               // Get 'site/index' from 'site/index'
```
