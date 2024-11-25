<?php include '../session_open.php'; ?>
<?php 
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"Not set");

//testy způsobilosti parametrů - upravit !!!
if ($myID==0) {
    $response=array("status"=>2,"param"=>"","message"=>"Nepřihlášený uživatel - nelze vkládat");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}

$target_dir = "../../".$doc_dir; //ověření adresáře pro upload
if (!file_exists($target_dir)) {
    if (!@mkdir($target_dir, 0777, true)) {
        $response=array("status"=>5,"param"=>"","message"=>"File ERROR: ".error_get_last()['message']);
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    } }

$articleID=filter_input(INPUT_POST, 'articleID', FILTER_VALIDATE_INT);
if (($articleID===NULL)||($articleID===false)) {
        $response=array("status"=>3,"param"=>"edition","message"=>"Parametr articleID nebyl správně předán");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
$articleTitle = filter_input(INPUT_POST, 'articleTitle', FILTER_UNSAFE_RAW);
$authors = filter_input(INPUT_POST, 'authors', FILTER_UNSAFE_RAW);
$edition = filter_input(INPUT_POST, 'edition', FILTER_UNSAFE_RAW);

$Status=0;if ($articleID!=0) {
    try {
        $sql="SELECT Status FROM `RSP_ARTICLE` WHERE ID=".$articleID." and (hasAccess(".$myID.",ID) or Creator=".$myID.")";
        $result = $conn->query($sql);
        if (!($Status=$result->fetch())) {
            $response=array("status"=>2,"param"=>"","message"=>"Článek není přístupný !!!");
            echo json_encode($response, JSON_PRETTY_PRINT);die;
        }
        $Status=$Status[0];
    } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
}
if (($articleID==0)||($Status==20)) { // insert nebo plný update musí mít data
    if ($articleTitle=="") {
        $response=array("status"=>3,"param"=>"articleTitle","message"=>"Prázdný titulek");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
    if ($authors=="") {
        $response=array("status"=>3,"param"=>"authors","message"=>"Autor neuveden");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
    if ($edition=="") {
        $response=array("status"=>3,"param"=>"edition","message"=>"Není vybrána edice");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
}   
if (empty($_FILES["document"])) { // kontrola dokumentu
    if ($articleID==0) { // při insertu musí být zadán 
        $response=array("status"=>4,"param"=>"document","message"=>"Žádný soubor nebyl nahrán");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
} else {
    $docFileType = strtolower(pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["document"]["size"] > 6000000) {
        $response=array("status"=>4,"param"=>"document","message"=>"Soubor je příliš velký - max 5MB");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
    // Allow certain file formats, only pdf and docx
    if($docFileType != "pdf" && $docFileType != "docx" && $docFileType != "doc") {
        $response=array("status"=>4,"param"=>"document","message"=>"Povoleny jsou pouze soubory PDF a DOC/X");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
}   }

if (empty($_FILES["image"])) { // kontrola obrázku
    if ($articleID==0) { // při insertu musí být zadán
        $response=array("status"=>4,"param"=>"image","message"=>"Žádný obrázek nebyl nahrán");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
} else {
    $imgFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["image"]["size"] > 1200000) {
        $response=array("status"=>4,"param"=>"image","message"=>"Obrázek je příliš velký - max 1MB");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
    // Allow certain file formats, only png
    if($imgFileType != "png") {
        $response=array("status"=>4,"param"=>"image","message"=>"Povoleny jsou pouze obrázky PNG");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
}

if ($articleID==0) { //vložení článku
    $in=0;
    $iv=0;
    //zápis do db
    try {
        $sql="INSERT INTO `RSP_ARTICLE` (`Edition`, `Title`, `Abstract`, `Status`, `ActiveVersion`, `Creator`) "
                . "VALUES (".$edition.",'".$articleTitle."', '".$_POST["abstract"]."', 10, NULL, ".$myID.")";
        $result = $conn->query($sql);
        $in = $conn->lastInsertId(); //insert_id article; 
    //    $response["message"]=var_export($in,true);

        $sql="INSERT INTO `RSP_VERSION` (`Document`, `Created`, `Published`, `Archived`, `Article`, `Status`, `Creator`) "
                . "VALUES ('".$_FILES["document"]["name"]."', now(), NULL, NULL, ".$in.", 10, ".$myID.")";
        $result = $conn->query($sql);
        $iv = $conn->lastInsertId(); //insert_id version; 

        $sql="UPDATE `RSP_ARTICLE` set ActiveVersion=".$iv." where ID=".$in;
        $result = $conn->query($sql);

        $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
                . "VALUES (now(), '".$myID."', NULL, ".$in.", 20, '".$_POST["note"]."', NULL, NULL)";
        $result = $conn->query($sql);

        $au=explode(",",$authors);
        $sql="INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES";
        foreach ($au as $a) {$sql.=" ('".$in."', '".$a."', 24, now(), NULL),";}
        $result = $conn->query(substr($sql, 0, -1));

        // výstup "OK"
        $response=array("status"=>1,"param"=>$in,"message"=>"Článek byl vytvořen");
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
        $response["message"].="\nSoubor ". htmlspecialchars( basename( $_FILES["document"]["name"])). " byl nahrán.";
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
        $response["message"].="\nSoubor ". htmlspecialchars( basename( $_FILES["image"]["name"])). " byl nahrán.";
        chmod($target_file, 0755);
    } else {
        $response=array("status"=>4,"param"=>"image","message"=>"Soubor obrazu se nepodařilo nahrát");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
} else { //editace článku
    if ($Status==20) {
        try {
            $sql="UPDATE `RSP_ARTICLE` SET `Edition`=".$edition.", `Title`='".$articleTitle."', `Abstract`='".$_POST["abstract"]."', `Status`=10 where ID=".$articleID;
            $result = $conn->query($sql);

            $sql="update `RSP_ARTICLE_ROLE` set Active_to=now() " //ukonči nezaslané
                    . "where Article=".$articleID." and ".(($authors!="")?"Person not in (".$authors.") and ":"")."Role=24";
            $result = $conn->query($sql);
            if ($authors!="") {
                $sql="Select GROUP_CONCAT(Person) list FROM `RSP_ARTICLE_ROLE` " // vyber zachované 
                    . "where Article=".$articleID." and Person in (".$authors.") and Role=24";
                $result = $conn->query($sql);
                $nID=",".$result->fetch()[0].",";
                $isNew=false;
                $au=explode(",",$authors); //a pridej tam ty co tam nebyli
                $sql="INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES";
                foreach ($au as $a) {if (!str_contains($nID,$a)) {
                    $sql.=" (".$articleID.", ".$a.", 24, now(), NULL),";
                    $isNew=true;
                }}
                if ($isNew) {
                    $result = $conn->query(substr($sql, 0, -1));  //fakt přidej, jen když je koho
                }   }
        $response=array("status"=>1,"param"=>$articleID,"message"=>"Článek byl upraven");
        } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
            echo json_encode($response, JSON_PRETTY_PRINT);die;
        }

        if (!empty($_FILES["image"])) { // Upload img file
            $target_file = "../../" . $img_dir . basename("picture".$articleID.'.'.$imgFileType);
            if (file_exists($target_file)) {
                unlink($target_file);
            }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $response["message"].="\nSoubor ". htmlspecialchars( basename( $_FILES["image"]["name"])). " byl nahrán.";
                chmod($target_file, 0755);
            } else {
                $response=array("status"=>4,"param"=>"image","message"=>"Soubor obrazu se nepodařilo nahrát");
                echo json_encode($response, JSON_PRETTY_PRINT);die;
    }   }   }
          
    if (!empty($_FILES["document"])) { // Upload doc file
        $iv="";try {
            $sql="INSERT INTO `RSP_VERSION` (`Document`, `Created`, `Published`, `Archived`, `Article`, `Status`, `Creator`) "
                    . "VALUES ('".$_FILES["document"]["name"]."', now(), NULL, NULL, ".$articleID.", 10, ".$myID.")";
            $result = $conn->query($sql);
            $iv = $conn->lastInsertId(); //insert_id version; 
            
            $sql="UPDATE `RSP_ARTICLE` set ActiveVersion=".$iv." where ID=".$articleID;
            if ($Status==20) $result = $conn->query($sql);

        } catch (Exception $ex) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
        }
        $target_file = $target_dir . basename("document".$iv.'.'.$docFileType);
        if (file_exists($target_file)) {
            $response=array("status"=>4,"param"=>"document","message"=>"Soubor {$target_file} již existuje");
            echo json_encode($response, JSON_PRETTY_PRINT);die;
        }
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
            $response["message"].="\nSoubor ". htmlspecialchars( basename( $_FILES["document"]["name"])). " byl nahrán.";
            chmod($target_file, 0755);
        } else {
            $response=array("status"=>4,"param"=>"document","message"=>"Soubor dokumentu se nepodařilo nahrát");
            echo json_encode($response, JSON_PRETTY_PRINT);die;
        }
    }
    try {
            $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
                    . "VALUES (now(), '".$myID."', NULL, ".$articleID.", 21, '".$_POST["note"]."', NULL, NULL)";
            $result = $conn->query($sql);
    } catch (Exception $ex) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
    }
    $response=array("status"=>1,"param"=>$articleID,"message"=>"Článek byl upraven");
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>
