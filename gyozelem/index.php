<?php
error_reporting(E_ALL);
require 'app/config/paths.php';
require LIB_PATH.DS.'functions.php';
require LIB_PATH.DS.'common.php';
spl_autoload_register('loadClass');

session_start();

Controller::init();