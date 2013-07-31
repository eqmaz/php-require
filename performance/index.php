<?php

/*
    For Quick debuging.
*/

error_reporting(E_ALL);
ini_set('display_errors', 'on');
header('Content-type: text/plain');

/*
    Measurment function.
*/

$cycle = 5000000;

function measure($last) {
    if ($last) {
        return microtime(true) - $last;
    }
    return microtime(true);
}

/*
    Standard PHP Class.
*/

$start = measure(null);

require_once("./class.php");

$class = new PhpClass();

for ($i = 0; $i < $cycle; $i++) {
    $class->fn();
}

print("Class: " . round(measure($start), 5) . "\n");

/*
    Nodejs style module with PhpClass.
*/

$start = measure(null);

require_once("../index.php");

$module = $require("./php-module");

for ($i = 0; $i < $cycle; $i++) {
    $module->fn();
}

print("Class via exports: " . round(measure($start), 5) . "\n");

/*
    Nodejs style module Function.
*/

$start = measure(null);

require_once("../index.php");

$module = $require("./anon-module");

for ($i = 0; $i < $cycle; $i++) {
    $module["fn"]();
}

print("Anonymous function via exports: " . round(measure($start), 5) . "\n");

echo "Done\n";