<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
$myID=0;if (isset($_SESSION['user'])&&isset($_SESSION['user']['id'])) $myID=$_SESSION['user']['id'];

include 'db.php';
$doc_dir = getenv('DIR_DOCUMENTS');
$img_dir = getenv('DIR_IMAGES');
$scriptName="";
$sql = "SELECT version from `RSP_DBVERSION` V order by TS desc limit 1";
$result = $conn->query($sql);
{$ver=$result->fetch()[0];
if ($ver!="1.1.1") {echo "Incorrect db version ".$ver." - 1.1.1 needed "; die;}
}
$myFunc=50; //not registered
if ($myID!=0) {$sql = "SELECT Func from `RSP_USER` U where ID=".$myID;
    $result = $conn->query($sql);
    $myFunc = $result->fetch()[0];}

?>
