<?php session_start();

// if logged in, redirect to index.php
if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    // check if username and password are set
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        // sanitaze input with filter_input
        $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        $sql = "SELECT * FROM users WHERE username = ':username' AND password = ':password'";

        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $result['email'];
                $_SESSION['id'] = $result['id'];
                header('Location: ../index.php');
            } else {
                header('Location: ../loginpage.php');
            }
        } else {
            header('Location: ../loginpage.php');
        }
    }
    
} else {
    header('Location: ../loginpage.php');
    
}


