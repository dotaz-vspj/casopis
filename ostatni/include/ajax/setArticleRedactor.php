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
if ($_POST["action"]=="1") { //SetStatus
  [$value,$event]=explode(',',$_POST["status"]);
  try {
    $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
    $result = $conn->query($sql);
    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event.", '".$_POST["note"]."', NULL, NULL)";
    $result = $conn->query($sql);

    // výstup "OK"
    $response["status"]=1;$response["param"]=$value;
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} } else if ($_POST["action"]=="2") { //SetOpponents
  try {
    $sql="update `RSP_ARTICLE_ROLE` set Active_to=now() " //ukonči nezaslané
            . "where Article=".$_POST["articleID"]." and ".(($_POST["opponents"]!="")?"Person not in (".$_POST["opponents"].") and ":"")."Role=21";
    $result = $conn->query($sql);
    if ($result->rowCount()>0) { //pokud se ukončovalo, pošli message
            $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), ".$myID.", NULL, ".$_POST["articleID"].", 11 , '".$_POST["note"]."', NULL, NULL)"; //odebráno k recenzi
            $result = $conn->query($sql);
    }
    if ($_POST["opponents"]!="") {
        $sql="Select GROUP_CONCAT(Person) list FROM `RSP_ARTICLE_ROLE` " // vyber zachované 
            . "where Article=".$_POST["articleID"]." and Person in (".$_POST["opponents"].") and Role=21";
        $result = $conn->query($sql);
        $nID=",".$result->fetch()[0].",";
        $isNew=false;
        $au=explode(",",$_POST["opponents"]); //a pridej tam ty co tam nebyli
        $sql="INSERT INTO `RSP_ARTICLE_ROLE` (`Article`, `Person`, `Role`, `Active_from`, `Active_to`) VALUES";
        foreach ($au as $a) {if (!str_contains($nID,$a)) {
            $sql.=" (".$_POST["articleID"].", ".$a.", 21, now(), NULL),";
            $isNew=true;
        }}
        if ($isNew) {
            $result = $conn->query(substr($sql, 0, -1));  //fakt přidej, jen když je koho
            $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
                . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", 4 , '".$_POST["note"]."', NULL, NULL)"; //přiděleno k recenzi
            $result = $conn->query($sql);  //pošli message
            $sql="Select count(Person) list FROM `RSP_ARTICLE_ROLE` " // spočti aktivní opponenty 
                . "where Article=".$_POST["articleID"]." and Person and Active_to is null and Role=21";
            $result = $conn->query($sql);  //kolik? jsou aspoň dva?
            if ($result->fetch()[0]>=2) {    // a případně změň stav
                $sql="UPDATE `RSP_ARTICLE` set status=4 where ID=".$_POST["articleID"];
                $result = $conn->query($sql);
                $response["param"]=4;
            } };
        $response["status"]=1;
    } 
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }

echo json_encode($response, JSON_PRETTY_PRINT);
?>
