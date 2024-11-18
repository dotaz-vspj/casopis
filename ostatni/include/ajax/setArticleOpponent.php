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
if (($_POST["action"]=="2")||($_POST["action"]=="4")) { //SetStatus
  [$value,$event]=explode(',',$_POST["status"]);
  try {
    $toChange=false;if ($_POST["action"]=="4") {
        $sql="select count(R.Person) from `RSP_ARTICLE_ROLE` R left join (select * from `RSP_EVENT` order by Datum desc limit 1) E on E.Autor=R.Person "
            . "where Article=".$_POST["articleID"]." and Role=21 and Active_to is null and Type not in (5,12)"; //najdi počet aktivní recenzenty, co nepřijali/nerecenzovali
        $result = $conn->query($sql);
        $toChange = ($result->fetch()[0]==0);
    }
    if ($toChange||($event==13)) {
        $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
        $result = $conn->query($sql);
    }
    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event.", '".$_POST["note"]."', NULL, NULL)";
    $result = $conn->query($sql);

    // výstup "OK"
    $response["status"]=1;$response["param"]=$value;
  } catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }
echo json_encode($response, JSON_PRETTY_PRINT);
?>
