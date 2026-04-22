<?php
/**
 * Vercel PHP Serverless Entry Point
 * 
 * Vercel's serverless environment requires an entry point handler.
 * This forwards requests from Vercel's edge network into the standard Laravel public index.
 */

// Suppress PHP 8.5 deprecation notices in production (e.g. PDO::MYSQL_ATTR_SSL_CA in vendor files)
error_reporting(E_ALL & ~E_DEPRECATED);

require __DIR__ . '/../public/index.php';
