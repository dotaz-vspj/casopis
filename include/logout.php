<?php session_start();

// check if request is get
// if is log user out by deleting session variables and redirect to index.php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_unset();
    session_destroy();
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}
