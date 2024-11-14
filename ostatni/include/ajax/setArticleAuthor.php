<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php 
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"Not set");
//testy způsobilosti parametrů - upravit !!!
if ($myID==0) {
    $response=array("status"=>2,"param"=>"","message"=>"Nepřihlášený uživatel - nelze vkládat");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["articleID"]!=0) {
    $response=array("status"=>2,"param"=>"articleID","message"=>"Editace není funkční (sprint3+), zatím implementováno jen vložení");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["articleTitle"]=="") {
    $response=array("status"=>3,"param"=>"articleTitle","message"=>"Prázdný titulek");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["authors"]=="") {
    $response=array("status"=>3,"param"=>"authors","message"=>"Autor neuveden");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// if ($_POST["document"]=="") {
//     $response=array("status"=>4,"param"=>"document","message"=>"Nepřipojený dokument");
//     echo json_encode($response, JSON_PRETTY_PRINT);die;
// }
// if ($_POST["image"]=="") {
//     $response=array("status"=>3,"param"=>"image","message"=>"Nepřipojený obrázek");
//     echo json_encode($response, JSON_PRETTY_PRINT);die;
// }
if ($_POST["edition"]=="") {
    $response=array("status"=>3,"param"=>"edition","message"=>"Není vybrána edice");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}

// upload a document file
$year = date("Y");
$edition = $_POST["edition"];
$target_dir = "../../public/archive/{$year}/{$edition}/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
if (empty($_FILES["document"])) {
    $response=array("status"=>4,"param"=>"document","message"=>"Žádný soubor nebyl nahrán");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$target_file = $target_dir . basename($_FILES["document"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    $response=array("status"=>4,"param"=>"document","message"=>"Soubor {$target_file} již existuje");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// Check file size
if ($_FILES["document"]["size"] > 5000000) {
    $response=array("status"=>4,"param"=>"document","message"=>"Soubor je příliš velký");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// Allow certain file formats, only pdf and docx
if($imageFileType != "pdf" && $imageFileType != "docx") {
    $response=array("status"=>4,"param"=>"document","message"=>"Povoleny jsou pouze soubory PDF a DOCX");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $response=array("status"=>4,"param"=>"document","message"=>"Chyba při nahrávání souboru");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
} else {
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        $response=array("status"=>1,"param"=>"document","message"=>"Soubor ". htmlspecialchars( basename( $_FILES["document"]["name"])). " byl nahrán.");
    } else {
        $response=array("status"=>4,"param"=>"document","message"=>"Soubor se nepodařilo nahrát");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
}



//zápis do db
try {
    $ed=$_POST["edition"];if(!is_numeric($ed)) $ed="NULL";
    $sql="INSERT INTO `RSP_ARTICLE` (`Edition`, `Title`, `Abstract`, `Status`, `ActiveVersion`, `Creator`) "
            . "VALUES (".$ed.",'".$_POST["articleTitle"]."', '".$_POST["abstract"]."', 1, NULL, ".$myID.")";
    $result = $conn->query($sql);
    $in = $conn->lastInsertId(); //insert_id; 
//    $response["message"]=var_export($in,true);

    $sql="INSERT INTO `RSP_VERSION` (`Document`, `Created`, `Published`, `Archived`, `Article`, `Status`, `Creator`) "
            . "VALUES ('".$_FILES["document"]["name"]."', now(), NULL, NULL, ".$in.", 1, ".$myID.")";
    $result = $conn->query($sql);

    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$in.", 3, '".$_POST["note"]."', NULL, NULL)";
    $result = $conn->query($sql);

    $au=explode(",",$_POST["authors"]);
    $sql="INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES";
    foreach ($au as $a) {$sql.=" ('".$in."', '".$a."', 24, now(), NULL),";}
    $result = $conn->query(substr($sql, 0, -1));

    // výstup "OK"
    $response["status"]=1;
} catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
