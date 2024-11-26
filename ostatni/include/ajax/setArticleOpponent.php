<?php include 'getOppSummary_php.php'; ?>
<?php include '../session_open.php'; ?>
<?php 
// návratový objekt
$response=array("status"=>0,"param"=>$_POST["action"],"message"=>"Not set");
//testy způsobilosti parametrů - upravit !!!
if ($myFunc>21) {
    $response=array("status"=>2,"param"=>"","message"=>"Nedostatečná oprávnění");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["articleID"]<=0){
    $response=array("status"=>2,"param"=>"articleID","message"=>"Chybný parametr ID článku");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
//zápis do db
$oppSum=getOppSummary($conn,$_POST["articleID"]);
if (($_POST["action"]=="1")) { //Zapsat stav
  [$value,$event]=explode(',',$_POST["status"]);
  try {
    if ($event==32) { //posuň stavy, pokud vrací nebo (je poslední co přijal, a čeká se na posun (30))
        if ($oppSum["acc"]+1==$oppSum["sum"]) {
            $sql="UPDATE `RSP_ARTICLE` set status=".$value." where status=30 and ID=".$_POST["articleID"];
            $result = $conn->query($sql);
    }   } else {
            $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
            $result = $conn->query($sql);
    }
    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event.", '".$_POST["note"]."', NULL, NULL)";
    $result = $conn->query($sql);

    // výstup "OK"
    $response=array("status"=>1,"param"=>$value,"message"=>"Oponentura potvrzena");
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }
if (($_POST["action"]=="2")) { //Zapsat recenzi
  switch ($_POST["data"]["Overall"]) {
      case 1: $value=40;$event=34; break;
      case 2:
      case 3: $value=10;$event=35; break;
      case 4:
      default: $value=10;$event=31; break;
  }
  $data=json_encode($_POST["data"]);
  try {
    if ($value==40) { //posuň stavy, pokud vrací nebo (je poslední co schválil, a čeká se na posun (31))
        if ($oppSum["done"]+1==$oppSum["sum"]){  //všichni OK 
        $sql="UPDATE `RSP_ARTICLE` set status=".$value." where status=31 and ID=".$_POST["articleID"]; //recenzováno
        $result = $conn->query($sql);
    }   } else {
            $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
            $result = $conn->query($sql);
    }

    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event." ,'".$_POST["note"]."','".$data."', NULL)";
    $result = $conn->query($sql);

    // výstup "OK"
    $response=array("status"=>1,"param"=>$value,"message"=>"Oponentura odeslána");
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }
echo json_encode($response, JSON_PRETTY_PRINT);
?>
