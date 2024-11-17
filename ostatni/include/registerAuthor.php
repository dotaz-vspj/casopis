<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php
// Z�sk�n� dat z POST po�adavku
$titleBefore = $_POST['titleBefore'] ?? null;
if ($titleBefore=="") $titleBefore=null;
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$titleAfter = $_POST['titleAfter'] ?? null;
if ($titleAfter=="") $titleAfter=null;
$email = $_POST['email'];
$login = $_POST['login'] ?? null;
if ($login=="") $login=null;
$phone = $_POST['phone'] ?? null;
if ($phone=="") $phone=null;

$response = ['status' => 0, 'id' => 0, 'message' => 'Neznámá chyba'];

try {
    $stmt = $conn->prepare("INSERT INTO RSP_USER (FirstName, LastName, TitleF, TitleP, Func, Phone, Mail, Login, Password, Active) "
         ." VALUES (?, ?, ?, ?, 24, ?, ?, ?, null, 1)");
    $stmt->execute([$firstName, $lastName, $titleBefore, $titleAfter, $phone, $email, $login]);
    $in = $conn->lastInsertId(); //insert_id; 

    $response = ['status' => 1, 'id' => $conn->lastInsertId() , 'message' => 'Autor úspěšně zaregistrován'];
} catch (PDOException $e) {
    $response = ['status' => 2, 'id' => 0 , 'message' => 'Chyba při vkládání do databáze: ' . $e->getMessage()];
}

echo json_encode($response);
?>