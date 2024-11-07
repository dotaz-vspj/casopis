<?php 
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
$myID=0;if (isset($_SESSION['user'])) $myID=$_SESSION['user']['id'];
$img_dir="../grafika/";
