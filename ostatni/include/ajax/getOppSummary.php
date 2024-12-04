<?php include '../session_open.php'; ?>
<?php include 'getOppSummary_php.php'; ?>
<?php 
$articleID=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
echo json_encode(getOppSummary($conn, $articleID), JSON_PRETTY_PRINT); ?>
