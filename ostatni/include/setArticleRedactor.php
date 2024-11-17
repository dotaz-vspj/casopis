<?php include '../session_open.php'; ?>
<?php include '../db.php'; ?>
<?php 
$myFunc=50; //not registered
if ($myID!=0) {$sql = "SELECT Func from `RSP_USER` U where ID=".$myID;
    $result = $conn->query($sql);
    $myFunc = $result->fetch()[0];}
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"Not set");
//testy způsobilosti parametrů - upravit !!!
if ($myFunc>12) {
    $response=array("status"=>2,"param"=>"","message"=>"Nedostatečná oprávnění");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($_POST["articleID"]<=0){
    $response=array("status"=>2,"param"=>"articleID","message"=>"Chybný parametr ID článku");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
[$value,$event]=explode(',',$_POST["value"]);
//zápis do db
if ($_POST["action"]=="setstatus") {
    try {
    $sql="UPDATE `RSP_ARTICLE` set status=".$value." where ID=".$_POST["articleID"];
    $result = $conn->query($sql);
    $in = $conn->lastInsertId(); //insert_id; 
//    $response["message"]=var_export($in,true);

    $sql="INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) " 
            . "VALUES (now(), '".$myID."', NULL, ".$_POST["articleID"].", ".$event.", '".$_POST["note"]."', NULL, NULL)";
    $result = $conn->query($sql);

    // výstup "OK"
    $response["status"]=1;
} catch(Exception $e) {$response=array("status"=>5,"param"=>"","message"=>"Database ERROR: ".$e->getMessage());
} }

echo json_encode($response, JSON_PRETTY_PRINT);
?>
