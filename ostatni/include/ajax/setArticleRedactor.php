<?php include 'getOppSummary_php.php'; ?>
<?php include '../session_open.php'; ?>
<?php 
// návratový objekt
$response=array("status"=>0,"param"=>$_POST["action"],"message"=>"Not set");
//testy způsobilosti parametrů - upravit !!!
if ($myFunc>12) {
    $response=array("status"=>2,"param"=>"","message"=>"Nedostatečná oprávnění");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["articleID"]<=0){
    $response=array("status"=>2,"param"=>"articleID","message"=>"Chybný parametr ID článku");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
//zápis do db
if ($_POST["action"]=="12") { //SetOpponents
  $value=12;
  try {
    $sql="update `RSP_ARTICLE_ROLE` set Active_to=now() " //ukonči nezaslané
            . "where Article=".$_POST["articleID"]." and ".(($_POST["opponents"]!="")?"Person not in (".$_POST["opponents"].") and ":"")."Role=21 and Active_to is null";
    $result = $conn->query($sql);
    if ($result->rowCount()>0) { //pokud se ukončovalo, pošli message
            $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), ".$myID.", NULL, ".$_POST["articleID"].", 19 , '".$_POST["note"]."', '".json_encode(explode(",",$_POST["opponents"]), JSON_PRETTY_PRINT)."', NULL)"; //odebráno k recenzi
            $result = $conn->query($sql);
    }
    if ($_POST["opponents"]!="") {
        $sql="Select GROUP_CONCAT(Person) list FROM `RSP_ARTICLE_ROLE` " // vyber zachované 
            . "where Article=".$_POST["articleID"]." and Person in (".$_POST["opponents"].") and Role=21 and Active_to is null";
        $result = $conn->query($sql);
        $nID=",".$result->fetch()[0].",";
        $isNew=false;
        $au=explode(",",$_POST["opponents"]); //a pridej tam ty co tam nebyli
        $sql="INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES";
        foreach ($au as $a) {if (!str_contains($nID,','.$a.',')) {
            $sql.=" (".$_POST["articleID"].", ".$a.", 21, now(), NULL),";
            $isNew=true;
        }}
        if ($isNew) {
            $result = $conn->query(substr($sql, 0, -1));  //fakt přidej, jen když je koho
            $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
                . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", 18 , '".$_POST["note"]."', '".json_encode($au, JSON_PRETTY_PRINT)."', NULL)"; //přiděleno k recenzi
            $result = $conn->query($sql);  //pošli message
            }
        $oppSum=getOppSummary($conn,$_POST["articleID"]);
        if ($oppSum["sum"]>=2) {$value=30;
            if ($oppSum["acc"]==$oppSum["sum"]) $value=31;
            if ($oppSum["agr"]==$oppSum["sum"]) {$value=40;
                $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
                . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", 14 , '".$_POST["note"]."', NULL, NULL)"; //předáno k publikaci
                $result = $conn->query($sql);  //pošli message
            }
            $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
            $result = $conn->query($sql);
        };
    $response=array("status"=>1,"param"=>$value,"message"=>"Předáno");
    } 
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} } else { //SetStatus
  [$value,$event]=explode(',',$_POST["status"]);
  if ($_POST["action"]=="10") { // set version
    if ($_POST["version"]<=0){
        $response=array("status"=>2,"param"=>"articleID","message"=>"Chybná verze článku");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
    try {
        $sql="UPDATE `RSP_ARTICLE` set ActiveVersion=".$_POST["version"]." where ID=".$_POST["articleID"]." and (ActiveVersion is null or ActiveVersion<>".$_POST["version"].")";
        $result = $conn->query($sql);
        $sql="UPDATE `RSP_ARTICLE` set Edition=".$_POST["edition"]." where ID=".$_POST["articleID"]." and (Edition is null or Edition<>".$_POST["edition"].")";
        if ($_POST["edition"]>0) $result = $conn->query($sql);
    } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
  } }
  try { //uprav stav a zapiš event
    $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
    $result = $conn->query($sql);
    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event.", '".$_POST["note"]."', NULL, NULL)";
    $result = $conn->query($sql);

    // výstup "OK"
        $response=array("status"=>1,"param"=>$value,"message"=>"Stav nastaven");

  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }

echo json_encode($response, JSON_PRETTY_PRINT);
?>
