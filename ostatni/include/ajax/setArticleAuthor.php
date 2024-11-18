<?php include '../session_open.php'; ?>
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
$target_dir = "../../".$doc_dir;
if (!file_exists($target_dir)) {
    if (!@mkdir($target_dir, 0777, true)) {
        $response=array("status"=>5,"param"=>"","message"=>"File ERROR: ".error_get_last()['message']);
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    } }

if (empty($_FILES["document"])) {
    $response=array("status"=>4,"param"=>"document","message"=>"Žádný soubor nebyl nahrán");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$docFileType = strtolower(pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION));
// Check file size
if ($_FILES["document"]["size"] > 5000000) {
    $response=array("status"=>4,"param"=>"document","message"=>"Soubor je příliš velký");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// Allow certain file formats, only pdf and docx
if($docFileType != "pdf" && $docFileType != "docx" && $docFileType != "doc") {
    $response=array("status"=>4,"param"=>"document","message"=>"Povoleny jsou pouze soubory PDF a DOC/X");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if (empty($_FILES["document"])) {
    $response=array("status"=>4,"param"=>"image","message"=>"Žádný obrázek nebyl nahrán");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$imgFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
// Check file size
if ($_FILES["image"]["size"] > 1000000) {
    $response=array("status"=>4,"param"=>"image","message"=>"Obrázek je příliš velký");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// Allow certain file formats, only png
if($imgFileType != "png") {
    $response=array("status"=>4,"param"=>"image","message"=>"Povoleny jsou pouze obrázky PNG");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$in=0;
$iv=0;
//zápis do db
try {
    $ed=$_POST["edition"];if(!is_numeric($ed)) $ed="NULL";
    $sql="INSERT INTO `RSP_ARTICLE` (`Edition`, `Title`, `Abstract`, `Status`, `ActiveVersion`, `Creator`) "
            . "VALUES (".$ed.",'".$_POST["articleTitle"]."', '".$_POST["abstract"]."', 1, NULL, ".$myID.")";
    $result = $conn->query($sql);
    $in = $conn->lastInsertId(); //insert_id article; 
//    $response["message"]=var_export($in,true);

    $sql="INSERT INTO `RSP_VERSION` (`Document`, `Created`, `Published`, `Archived`, `Article`, `Status`, `Creator`) "
            . "VALUES ('".$_FILES["document"]["name"]."', now(), NULL, NULL, ".$in.", 1, ".$myID.")";
    $result = $conn->query($sql);
    $iv = $conn->lastInsertId(); //insert_id version; 

    $sql="UPDATE `RSP_ARTICLE` set ActiveVersion=".$iv." where ID=".$in;
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
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}

// Upload doc file
$target_file = $target_dir . basename("document".$iv.'.'.$docFileType);
if (file_exists($target_file)) {
    $response=array("status"=>4,"param"=>"document","message"=>"Soubor {$target_file} již existuje");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
    $response=array("status"=>1,"param"=>"document","message"=>"Soubor ". htmlspecialchars( basename( $_FILES["document"]["name"])). " byl nahrán.");
    chmod($target_file, 0755);
} else {
    $response=array("status"=>4,"param"=>"document","message"=>"Soubor dokumentu se nepodařilo nahrát");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
// Upload img file
$target_file = "../../" . $img_dir . basename("picture".$in.'.'.$imgFileType);
if (file_exists($target_file)) {
    $response=array("status"=>4,"param"=>"image","message"=>"Soubor {$target_file} již existuje");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $response=array("status"=>1,"param"=>"","message"=>"Soubor ". htmlspecialchars( basename( $_FILES["image"]["name"])). " byl nahrán.");
    chmod($target_file, 0755);
} else {
    $response=array("status"=>4,"param"=>"image","message"=>"Soubor obrazu se nepodařilo nahrát");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
