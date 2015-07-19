<?php
/**
* PHPCI - Continuous Integration for PHP
*
* @copyright    Copyright 2014, Block 8 Limited.
* @license      https://github.com/Block8/PHPCI/blob/master/LICENSE.md
* @link         https://www.phptesting.org/
*/

session_set_cookie_params(43200); // Set session cookie to last 12 hours.
session_start();

require_once(__DIR__ . '/../bootstrap.php');

/** @var PHPCI\Application */
$app = $container->get('application');

print $app->handleRequest();
