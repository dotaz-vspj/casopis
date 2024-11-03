<?php 
session_start();

require_once 'db.php';
include_once 'functions.php';

if (!empty($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_UNSAFE_RAW);

    

    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        $_SESSION['error'] = 'Vyplňte všechny údaje';
        header('Location: ../registerpage.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Neplatný email';
        header('Location: ../registerpage.php');
        exit();
    }

    if ($password != $password_confirm) {
        $_SESSION['error'] = 'Hesla se neshodují';
        header('Location: ../registerpage.php');
        exit();
    }

    try {
        $sql = "SELECT * FROM RSP_USER WHERE Mail = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Chyba při ověřování uživatele: ' . $e->getMessage();
        header('Location: ../registerpage.php');
        exit();
    }
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['error'] = 'Uživatel s tímto emailem již existuje';
        header('Location: ../registerpage.php');
        exit();
    }

    // get all other possible data in post
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_UNSAFE_RAW);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_UNSAFE_RAW);
    $title_f = filter_input(INPUT_POST, 'title_f', FILTER_UNSAFE_RAW);
    $title_p = filter_input(INPUT_POST, 'title_p', FILTER_UNSAFE_RAW);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_UNSAFE_RAW);
    $function = filter_input(INPUT_POST, 'function', FILTER_UNSAFE_RAW);
    $active = filter_input(INPUT_POST, 'active', FILTER_UNSAFE_RAW);

    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `RSP_USER` (`Login`, `Mail`, `Password`, `FirstName`, `LastName`, `TitleF`, `TitleP`, `Phone`, `Func`, `Active`) 
            VALUES (:username, :email, :password, :first_name, :last_name, :title_f, :title_p, :phone, :function, :active)";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':title_f', $title_f, PDO::PARAM_STR);
        $stmt->bindParam(':title_p', $title_p, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':function', $function, PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Chyba při registraci uživatele: ' . $e->getMessage();
        header('Location: ../registerpage.php');
        exit();
    }

    $_SESSION['success'] = 'Registrace proběhla úspěšně';

    // EDIT: Do not login user after registration
    // // login user after registration
    // $session_hash = bin2hex(random_bytes(12));
    // $last_id = $conn->lastInsertId();
    // $sql = "INSERT INTO RSP_SESSION (`Login`, `TS`, `SessionTag`) VALUES (:login, NOW(), :session_tag)";

    // try {

    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':login', $last_id, PDO::PARAM_INT);
    //     $stmt->bindParam(':session_tag', $session_hash, PDO::PARAM_STR);
    //     echo "<br>here";
    //     $stmt->execute();
    // } catch (PDOException $e) {
    //     $_SESSION['error'] = 'Chyba při vytváření relace: ' . $e->getMessage();
    //     header('Location: ../registerpage.php');
    //     exit();
    // }

    // $_SESSION['user'] = ['username' => $username, 'email' => $email, 'id' => $last_id, 'session_tag' => $session_hash];
    header('Location: ../index.php');
    exit();
}