<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
use yii\helpers\VarDumper;

/**
 *  debug script
 *
 * @param      $var
 * @param bool $exit
 */
function prn($var, $exit = false)
{
    VarDumper::dump(get_caller_info());
    VarDumper::dump($var, 10, true);
    if ($exit) {
        die('Exit');
    }
    echo '<br />';
}

/**
 * @param $var
 */
function prnx($var)
{
    prn($var, true);
}

/**
 * @return string
 */
function get_caller_info()
{
    $c = null;
    $file = null;
    $func = null;
    $class = null;
    $trace = debug_backtrace();
    $line = $trace[1]['line'] ?? null;

    if (isset($trace[2])) {
        $file = $trace[1]['file'];
        $func = $trace[2]['function'];
        if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
            $func = null;
        }
    } else {
        if (isset($trace[1])) {
            $file = $trace[1]['file'];
            $func = null;
        }
    }

    if (isset($trace[3]['class'])) {
        $class = $trace[3]['class'];
        $func = $trace[3]['function'];
        $file = $trace[2]['file'] ?? $trace[1]['file'];
    } else {
        if (isset($trace[2]['class'])) {
            $class = $trace[2]['class'];
            $func = $trace[2]['function'];
            $file = $trace[1]['file'];
        }
    }

    if ($file) {
        $file = basename($file);
    }

    $c = $file;
    $c .= $line ? ' (' . $line . ')' : false;
    $c .= $class ? ': ' . $class . '->' : false;
    $c .= $func ? $func . '(): ' : false;

    return $c . PHP_EOL;
}
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
