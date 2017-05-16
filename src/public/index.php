<?php

if (version_compare('7.1.0', PHP_VERSION, '>')) {
    printf('This application requires PHP 7.1. You are using PHP %s',
        PHP_VERSION);
    exit;
}

require '../../vendor/autoload.php';

require '../routes.php';
