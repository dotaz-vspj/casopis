<?php include '../session_open.php'; ?>
<?php
$Type="v";if (isset($_GET['typ'])) $Type=htmlentities($_GET['typ']);
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
if (!is_numeric($FilterID)||($FilterID==0)) {echo "noID";die;}
try {
if ($Type=="v")  {$name="document";$sql="select V.ID,V.Document from RSP_ARTICLE A left join RSP_VERSION V on A.ActiveVersion=V.ID "
    . "where A.ID=".$FilterID." and hasAccess(".$myID.",A.ID)";}
else if ($Type=="o") {$name="event";$sql="select E.ID,E.Document from RSP_EVENT E "
    . "where E.ID=".$FilterID." and hasAccess(".$myID.",E.Article)";}
else {echo "Type not valid.";die;}
    $result = $conn->query($sql);
    [$IDv,$filename]=$result->fetch();
    if ($IDv=="") {echo "noFile";die;}
// echo $$doc_dir."###".$filename; die;
    $docFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . $filename . "\""); 
    readfile("../../".$doc_dir.$name.$IDv.".".$docFileType); 
    
} catch(Exception $e) {echo "Other error: ".$e->getMessage();die;}

?>