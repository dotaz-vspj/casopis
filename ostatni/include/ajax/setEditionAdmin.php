<?php include '../session_open.php'; ?>
<?php
header('Content-Type: application/json');
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"Not set");

// Získání dat z POST požadavku
$id = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT) ? $_POST['ID'] : 0;
$title = filter_input(INPUT_POST, 'Title', FILTER_UNSAFE_RAW);
$thema = filter_input(INPUT_POST, 'Thema', FILTER_UNSAFE_RAW);
$published = filter_input(INPUT_POST, 'Published', FILTER_UNSAFE_RAW);
$note = filter_input(INPUT_POST, 'note', FILTER_UNSAFE_RAW);

// Validace vstupních dat
if (empty($title)) {
    $response=['status' => 2,'param' => 'Title','message' => 'Titulek nesmí být prázdný.'];
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$published=($published)?$published:NULL;
if ($published && !preg_match("/^\d{4}-\d{2}-\d{2}$/", $published)) {
    $response = ['status' => 2, 'param' => 'Published', 'message' => 'Neplatný formát data.'];
    echo json_encode($response, JSON_PRETTY_PRINT); die;
}
// Začínáme transakci
$conn->beginTransaction();
if ($id>0) {
    $sql = "UPDATE RSP_EDITION SET Title = :title, Thema = :thema, Published = :published, Redactor = :redactor WHERE ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
} else {
    $sql = "INSERT INTO RSP_EDITION (Title,Thema,Published,Redactor) VALUES (:title,:thema,:published,:redactor)";
    $stmt = $conn->prepare($sql);
}
try {
    // 1. Update záznamu v tabulce RSP_EDITION
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':thema', $thema, PDO::PARAM_STR);
    $stmt->bindParam(':published', $published, PDO::PARAM_STR);
    $stmt->bindParam(':redactor', $myID, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($id==0) $id = $conn->lastInsertId();
    
    $stmt = $conn->prepare("INSERT INTO RSP_EVENT (Datum, Autor, Edition, Type, Message) VALUES (now(), :autor, :edition, :type, :message)");
    $stmt->execute(['autor' => $myID, 'edition'=>$id, 'type'=>(($published==NULL)?2:15), 'message' => $note ]);
    $conn->commit();
    $response=['status' => 1,'param' => 0,'message' => 'Úpravy byly úspěšně uloženy.'];
} catch (Exception $e) {
    $conn->rollBack();
    $response=['status' => 3,'param' => 0,'message' => 'DB chyba: '. $e->getMessage()];
}
echo json_encode($response, JSON_PRETTY_PRINT);
