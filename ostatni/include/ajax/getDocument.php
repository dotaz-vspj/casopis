<?php include '../session_open.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
if (!is_numeric($FilterID)||($FilterID==0)) {echo "noID";die;}
try {
    $sql="select V.ID,V.Document from RSP_ARTICLE A left join RSP_VERSION V on A.ActiveVersion=V.ID "
            . "where A.ID=".$FilterID." and hasAccess(".$myID.",A.ID)";
    $result = $conn->query($sql);
    [$IDv,$filename]=$result->fetch();
    if ($IDv=="") {echo "noFile";die;}
// echo $$doc_dir."###".$filename; die;
    $docFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . $filename . "\""); 
    readfile("../../".$doc_dir."document".$IDv.".".$docFileType); 
    
} catch(Exception $e) {echo "Other error: ".$e->getMessage();die;}

?>