<?php
session_start();
require_once 'db.php'; // Include your database connection file
include_once 'functions.php'; // Include your functions file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    // Check if the username and password are not empty
    if (!empty($username) && !empty($password)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT `ID`, `Password` FROM `RSP_USER` WHERE `Login` = :username LIMIT 1");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        // Check if the user exists
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if (password_verify($password, $result['Password'])) {
                // Set session variables
                $session_hash = bin2hex(random_bytes(12));

                // if user's id was found in rsp_session table, update the session tag and TS
                // query the rsp_session table for the user's
                $sql = "SELECT * FROM RSP_SESSION WHERE Login = :login LIMIT 1";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':login', $result['ID'], PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // update the session tag and TS
                    $sql = "UPDATE RSP_SESSION
                        SET TS = NOW(), SessionTag = :session_tag
                        WHERE Login = :login";

                    try {
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':login', $result['ID'], PDO::PARAM_INT);
                        $stmt->bindParam(':session_tag', $session_hash, PDO::PARAM_STR);
                        if ($stmt->execute()) {
                            $_SESSION['user'] = ['username' => $username, 'id' => $result['ID'], 'session_tag' => $session_hash];
                            // Redirect to profile.php
                            header("Location: ../profile.php");
                            exit();
                        }
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Chyba při vytváření relace: ' . $e->getMessage();
                        header('Location: login.php');
                        exit();
                    }
                } else {
                    // insert the session tag and TS
                    $sql = "INSERT INTO RSP_SESSION (`Login`, `TS`, `SessionTag`) VALUES (:login, NOW(), :session_tag)";

                    try {
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':login', $result['ID'], PDO::PARAM_INT);
                        $stmt->bindParam(':session_tag', $session_hash, PDO::PARAM_STR);
                        if ($stmt->execute()) {
                            $_SESSION['user'] = ['username' => $username, 'id' => $result['ID'], 'session_tag' => $session_hash];
                            // Redirect to profile.php
                            header("Location: ../profile.php");
                            exit();
                        }
                    } catch (PDOException $e) {
                        $_SESSION['error'] = 'Chyba při vytváření relace: ' . $e->getMessage();
                        header('Location: login.php');
                        exit();
                    }

                }

                $stmt = null;
                $_SESSION['user'] = ['username' => $username, 'email' => $email, 'id' => $last_id, 'session_tag' => $session_hash];

                // Redirect to profile.php
                header("Location: profile.php");
                exit();

            } else {
                $_SESSION['error'] = '2:Špatné jméno nebo heslo';
                header('Location: ../loginpage.php');
                exit();
            }

        } else {
            $_SESSION['error'] = '1:Špatné jméno nebo heslo';
            header('Location: ../loginpage.php');
            exit();
        }

    } else {
        $_SESSION['error'] = 'Please fill in both fields.';
        // header('Location: ../loginpage.php');
        exit();
    }
}
