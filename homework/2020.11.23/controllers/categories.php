<?php
require_once __DIR__ . '/../models/Actionwithcategories.php';
require_once __DIR__ . '/Create.php';
require_once __DIR__ . '/Delete.php';
require_once __DIR__ . '/ShowAll.php';
require_once __DIR__ . '/Show.php';
require_once __DIR__ . '/SignOut.php';
require_once __DIR__ . '/Update.php';
/** @var var $class */

$action = new $class();

$nameOfFunction = 'action'. $class;

$action->$nameOfFunction();