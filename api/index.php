<?php

// Set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Check if vendor autoload exists
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Vendor directory not found. Please run composer install.');
}

// Forward Vercel requests to public/index.php
require __DIR__ . '/../public/index.php';
