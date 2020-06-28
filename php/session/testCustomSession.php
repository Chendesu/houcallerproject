<?php
require_once 'customSession.php';
$CustomSession = new CustomSession;
ini_set('session.save_handler','user');
session_set_save_handler($CustomSession,true);
session_start();
$_SESSION['username'] = 'ling';
$_SESSION['age'] = 23;
// print_r($_SESSION);
// session_destroy();