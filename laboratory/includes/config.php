<?php
// if (extension_loaded('gd')) {
//     echo "GD extension is enabled.";
// } else {
//     echo "GD extension is not enabled.";
// }
// exit;
// Enable error reporting
// error_reporting(E_ALL);  // Report all types of errors
// ini_set('display_errors', 1);  // Display errors on the screen

// Your existing code...

define("BASE_URL", "https://vividtranstech.com/limstest/laboratory/");
define("BASE_URL_API", "login.php");
define("DB_HOST", "localhost");
define("DB_USER", "vividtranstech_lims");
define("DB_PASS", "vividtranstech_lims");
define("DB_NAME", "vividtranstech_limstest");
//Asia/Kolkata
$tz = 'Asia/Kolkata';
date_default_timezone_set($tz);