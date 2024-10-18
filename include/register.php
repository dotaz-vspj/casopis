<?php session_start();

// check if user is logged in
// if yes redirect to profile.php
// if request is post check if all fields are filled
// if yes check if password and password_confirm are the same
// if yes check if email is unique
// if yes hash password and insert user into database
// if no redirect to registerpage.php
if (isset($_SESSION['username']) || isset($_SESSION['email']) || isset($_SESSION['id'])) {
    header('Location: ../profile.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    // check if all fields are filled
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        // check if password and password_confirm are the same
        if ($password === $password_confirm) {

            $sql = "SELECT * FROM users WHERE email = :email";

            // prepare and bind
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // check if email is unique
            if (!$result) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

                // prepare and bind
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hash);
                $stmt->execute();

                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $conn->lastInsertId();
                header('Location: ../profile.php');
            } else {
                header('Location: ../registerpage.php');
            }
        } else {
            header('Location: ../registerpage.php');
        }
    } else {
        header('Location: ../registerpage.php');
    }
} else {
    header('Location: ../registerpage.php');
}
