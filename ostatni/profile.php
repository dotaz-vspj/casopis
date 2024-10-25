<?php session_start(); ?>
<?php include 'include/header.php'; ?>

<?php

// find user in rsp_session table
if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM RSP_SESSION WHERE Login = :login AND `SessionTag` = :session_tag LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':login', $_SESSION['user']['id'], PDO::PARAM_INT);
    $stmt->bindParam(':session_tag', $_SESSION['user']['session_tag'], PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $session = $stmt->fetch();
        echo '<p>Session Hash: ' . htmlspecialchars($session['SessionTag']) . '</p>';
    }
}