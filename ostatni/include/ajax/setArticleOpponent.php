<?php include 'getOppSummary_php.php'; ?>
<?php include 'setDocument_php.php';
// function checkDocument ($target_dir, $documentID, $empty, $maxSize, $types) {
// function setDocument ($target_file,$documentID){
?>
<?php include '../session_open.php'; ?>
<?php 
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"No action");
//testy způsobilosti parametrů - upravit !!!
if ($myFunc>21) {
    $response=array("status"=>2,"param"=>"","message"=>"Nedostatečná oprávnění");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["articleID"]<=0){
    $response=array("status"=>2,"param"=>"articleID","message"=>"Chybný parametr ID článku");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
    $sql="select count(Person) from RSP_ARTICLE_ROLE "
            . "where Role=21 and (Active_to is null or Active_to>now()) and Article=".$_POST["articleID"]." and Person=".$myID;
    $result = $conn->query($sql);
if ($result->fetch()[0]==0){
    $response=array("status"=>2,"param"=>"","message"=>"Nejste aktivním oponentem článku !");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if (!empty($_FILES["document"])) {
    $response=checkDocument ("../../".$doc_dir, "document", false, 2500000, ["pdf","docx","doc"]);
    if ($response["status"]!=1) {
        echo json_encode($response, JSON_PRETTY_PRINT);die;
}   }
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
    if ($value==40) { //posuň stavy, pokud je kladná, a ***
        if ($oppSum["done"]+1==$oppSum["sum"]) { // ***=je to poslední recenze -> to by mohlo být na schválení
            if ($oppSum["sum"]<2) $value=10;  // (ale není jich dost, tak v tom případě to vrať)
            if ($oppSum["agr"]+1!=$oppSum["sum"]) $value=10;  // (ale nejsou všechny OK, tak v tom případě to vrať)
            $sql="UPDATE `RSP_ARTICLE` set status=".$value." where status=31 and ID=".$_POST["articleID"]; //vrátit nebo schváleno
            $result = $conn->query($sql);
    }   } else { // nebo to vrať, když je záporná
            $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
            $result = $conn->query($sql);
    }

    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event." ,'".$_POST["note"]."','".$data."', NULL)";
    $result = $conn->query($sql);
    $ie = $conn->lastInsertId(); //insert_id event; 
    if (!empty($_FILES["document"])) { // Upload doc file
        $response=setDocument ("../../" . $doc_dir . basename("event".$ie.'.'.strtolower(pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION))),"document",0);
        if ($response["status"]!=1) {
            echo json_encode($response, JSON_PRETTY_PRINT);die;
        }
        try {
            $sql="UPDATE `RSP_EVENT` set Document='".$_FILES["document"]["name"]."' where ID=".$ie;
            $result = $conn->query($sql);
        } catch (Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
            echo json_encode($response, JSON_PRETTY_PRINT);die;
        }
    }

    // výstup "OK"
    $response=array("status"=>1,"param"=>$value,"message"=>"Oponentura odeslána");
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }
echo json_encode($response, JSON_PRETTY_PRINT);
?>
