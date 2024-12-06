<?php include '../session_open.php'; ?>
<?php
header('Content-Type: application/json');
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"Not set");

// Získání dat z POST požadavku
$note = filter_input(INPUT_POST, 'note', FILTER_UNSAFE_RAW);

// Validace vstupních dat
if ($myID==0) {
    $response=['status' => 2,'param' => '','message' => 'Nepřihlášený uživatel.'];
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($note=="") {
    $response=['status' => 2,'param' => '','message' => 'Zpráva je prázdná.'];
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}

// Začínáme transakci
$conn->beginTransaction();
try {
    $stmt = $conn->prepare("INSERT INTO RSP_EVENT (Datum, Autor, Edition, Type, Message) VALUES (now(), :autor, null, 9, :message)");
    $stmt->execute(['autor' => $myID, 'message' => $note ]);
    $conn->commit();
    $response=['status' => 1,'param' => 0,'message' => 'Zpráva byla odeslána.'];
} catch (Exception $e) {
    $conn->rollBack();
    $response=['status' => 3,'param' => 0,'message' => 'DB chyba: '. $e->getMessage()];
}
echo json_encode($response, JSON_PRETTY_PRINT);
