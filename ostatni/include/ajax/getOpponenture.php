<?php include "../session_open.php";
// Získání ID z parametrů URL (GET request)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Příprava SQL dotazu pro získání dat z tabulky RSP_EVENT
    $sql = "SELECT * FROM RSP_EVENT WHERE ID = ".$id;
    $result = $conn->query($sql);

    // Zkontrolujeme, zda je záznam nalezen
    if ($row = $result->fetchObject()) {
        // Předpokládám, že v posledním řádku je JSON v atributu 'Data'
        $data = json_decode($row->Data, true);
        // Pokud jsou data validní, vrátíme je jako JSON
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "Data nejsou ve správném formátu."]);
        }
    } else {
        echo json_encode(["error" => "Záznam s tímto ID nebyl nalezen."]);
    }
} else {
    echo json_encode(["error" => "ID nebylo poskytnuto."]);
}
?>