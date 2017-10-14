<?php 
//error_reporting(0);
if(session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_SESSION['userName'] = 'stepouts_platinm';
$_SESSION['db'] = 'stepouts_shantanu_platinumHeights';
$_SESSION['password'] = 'pass3word#';
$_SESSION['server'] = 'localhost';

?>