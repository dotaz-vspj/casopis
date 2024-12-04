<?php include '../session_open.php'; ?>
<?php include 'setDocument_php.php';
// function checkDocument ($target_dir, $documentID, $empty, $maxSize, $types) {
// function setDocument ($target_file,$documentID){
?>
<?php 
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"No action");
//var_dump($_POST);
//testy způsobilosti parametrů - upravit !!!
if ($myID==0) {
    $response=array("status"=>2,"param"=>"","message"=>"Nepřihlášený uživatel - nelze vkládat");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}

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
$response=checkDocument ("../../".$doc_dir, "document", ($articleID==0), 6000000, ["pdf","docx","doc"]);
if ($response["status"]!=1) {
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$response=checkDocument ("../../".$img_dir, "image", ($articleID==0), 1200000, ["jpg","gif","png"]);
if ($response["status"]!=1) {
    echo json_encode($response, JSON_PRETTY_PRINT);die;
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
    $respf=setDocument ("../../" . $doc_dir . basename("document".$iv.'.'.strtolower(pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION))),"document",0);
    if ($respf["status"]!=1) {
        echo json_encode($respf, JSON_PRETTY_PRINT);die;
    } else $response["message"].="<br/>\n".$respf["message"];
    // Upload img file
    $respf=setDocument ("../../" . $img_dir . basename("picture".$in.'.'.strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION))),"image",0);
    if ($respf["status"]!=1) {
        echo json_encode($respf, JSON_PRETTY_PRINT);die;
    } else $response["message"].="<br/>\n".$respf["message"];
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
            $respf=setDocument ("../../" . $img_dir . basename("picture".$articleID.'.'.strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION))),"image",1);
            if ($respf["status"]!=1) {
                echo json_encode($response, JSON_PRETTY_PRINT);die;
            } else $respf["message"].="<br/>\n".$respf["message"];
    }   }
          
    if (!empty($_FILES["document"])) { // Upload doc file
        $iv="";try {
            $sql="INSERT INTO `RSP_VERSION` (`Document`, `Created`, `Published`, `Archived`, `Article`, `Status`, `Creator`) "
                    . "VALUES ('".$_FILES["document"]["name"]."', now(), NULL, NULL, ".$articleID.", 10, ".$myID.")";
            $result = $conn->query($sql);
            $iv = $conn->lastInsertId(); //insert_id version; 
            
            $sql="UPDATE `RSP_ARTICLE` set ActiveVersion=".$iv." where ID=".$articleID;
            if ($Status==20) $result = $conn->query($sql);

        } catch (Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
        }
        $respf=setDocument ("../../" . $doc_dir . basename("document".$iv.'.'.strtolower(pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION))),"document",0);
        if ($respf["status"]!=1) {
            echo json_encode($respf, JSON_PRETTY_PRINT);die;
        } else $response["message"].="<br/>\n".$respf["message"];
    }
    try {
            $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
                    . "VALUES (now(), '".$myID."', NULL, ".$articleID.", 21, '".$_POST["note"]."', NULL, NULL)";
            $result = $conn->query($sql);
    } catch (Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
    }
    $response=array("status"=>1,"param"=>$articleID,"message"=>"Článek byl upraven");
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>
