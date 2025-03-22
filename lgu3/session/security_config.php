<?php

$isDevelopment = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1');

if ($isDevelopment) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => 'localhost', 
        'secure' => false, 
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
} else {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => 'crms.unifiedlgu.com', 
        'secure' => true,   
        'httponly' => true,
        'samesite' => 'Strict'
    ]);

}



?>