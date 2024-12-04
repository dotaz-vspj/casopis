<?php include '../session_open.php'; ?>
<?php
$FilterID=0;if (isset($_GET['id'])) $FilterID=htmlentities($_GET['id']);
$data = [];if (is_numeric($FilterID)&&($FilterID!=0)) {
    $sql="select * from RSP_ARTICLE where ID=".$FilterID;
    $result = $conn->query($sql);
    $data[]=$result->fetchObject();
    $sql="select GROUP_CONCAT(Person) as authors from RSP_ARTICLE_ROLE "
            . "where Role=24 and (Active_to is null or Active_to>now()) and Article=".$FilterID;
    $result = $conn->query($sql);
    $data[0]->authors=$result->fetch()['authors'];
    $sql="select GROUP_CONCAT(Person) as opponents from RSP_ARTICLE_ROLE "
            . "where Role=21 and (Active_to is null or Active_to>now()) and Article=".$FilterID;
    $result = $conn->query($sql);
    $data[0]->opponents=$result->fetch()['opponents'];
}
echo json_encode($data, JSON_PRETTY_PRINT);
?>