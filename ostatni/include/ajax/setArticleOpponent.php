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
if (($_POST["action"]=="1")) { //Zapsat stav
  [$value,$event]=explode(',',$_POST["status"]);
  try {
    $toChange=false;if ($_POST["action"]=="4") { //pouze stav K recenzi se dá poslat dál
        $sql="select count(R.Person) from `RSP_ARTICLE_ROLE` R " //najdi (počet) nerozhodnutých recenzentů, co nepřijali/nerecenzovali
                . "where R.Article=".$_POST["articleID"]." and Role=21 and Active_to is null "
                . "and (SELECT type from `RSP_EVENT` E where E.Autor=R.Person order by ID desc limit 1) not in (32,34)"; 
        $result = $conn->query($sql);
        $toChange = ($result->fetch()[0]==0);
    }
    if ($toChange||($event==13)) {  //všichni OK nebo Odmítnout
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
    $toChange=false;if ($_POST["action"]=="31") { //pouze stav K recenzi se dá poslat dál
        $sql="select count(R.Person) from `RSP_ARTICLE_ROLE` R " //najdi (počet) recenzentů, co nerecenzovali
                . "where R.Article=".$_POST["articleID"]." and Role=21 and Active_to is null "
                . "and (SELECT type from `RSP_EVENT` E where E.Autor=R.Person order by ID desc limit 1) not in (34,35)"; 
        $result = $conn->query($sql);
        $toChange = ($result->fetch()[0]==0);
    }
    if (($toChange)||($value==10)) {  //všichni OK nebo vrať
        $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"]; //recenzováno
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
