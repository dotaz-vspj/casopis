<?php include '../session_open.php'; ?>
<?php
// návratový objekt
$response=array("status"=>0,"param"=>"","message"=>"Not set");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $response=array("status"=>2,"param"=>"","message"=>"Nesprávné volání (POST).");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$userName = filter_input(INPUT_POST, 'Login', FILTER_UNSAFE_RAW);
$firstName = filter_input(INPUT_POST, 'FirstName', FILTER_UNSAFE_RAW);
$lastName = filter_input(INPUT_POST, 'LastName', FILTER_UNSAFE_RAW);
$email = filter_input(INPUT_POST, 'Mail', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'passwd1', FILTER_UNSAFE_RAW);
$password2 = filter_input(INPUT_POST, 'passwd2', FILTER_UNSAFE_RAW);
$userID=filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
//povinné parametry
if (($userID=="")||(!is_numeric($userID))) {
    $response=array("status"=>2,"param"=>'ID',"message"=>"Chybné číslo záznamu USER");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if (($lastName=="")||($firstName=="")||($email=="")) {
    $response=array("status"=>2,"param"=>(($lastName=="")?'LastName':(($firstName=="")?'FirstName':'Mail')),"message"=>"Chybí povinný parametr");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response=array("status"=>2,"param"=>'Mail',"message"=>"Špatný formát E-mail");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
if ($myFunc==50) { 
    if (($userName=="")||($password=="")) {
        $response=array("status"=>2,"param"=>(($userName=="")?'Login':'passwd1'),"message"=>"Chybí povinný parametr");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
    $Func=23;
} else {
    $Func=filter_input(INPUT_POST, 'Func', FILTER_VALIDATE_INT);if ($myFunc==22) $Func=24;
    if (($Func=="")||(!is_numeric($Func))||($Func==0)) {
        $response=array("status"=>2,"param"=>"Func","message"=>"Funkce není nastavena");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    } 
}
if ($password!=$password2) {
    $response=array("status"=>2,"param"=>'passwd2',"message"=>"Hesla se neshodují");
    echo json_encode($response, JSON_PRETTY_PRINT);die;
}
$active=(($_POST['Active']=="true")?1:0);
if ($active==1) {
    $sql='SELECT count(*), case when Login="'.$userName.'" then 1 else 0 end lg FROM RSP_USER'
            . ' where Active=1 and ID<>'.$userID.' and (Login="'.$userName.'" or Mail="'.$email.'") group by Login';
    $result = $conn->query($sql);
    [$res,$lg]=$result->fetch();
//        $response=array("status"=>2,"param"=>(($lg==1)?'Login':'Mail'),"message"=>"VAR:".$userName.'-'.$userID.'-'.$res.'-'.$lg."\n".$sql);
//        echo json_encode($response, JSON_PRETTY_PRINT);die;
    if ($res!=0) {
        $response=array("status"=>2,"param"=>(($lg==1)?'Login':'Mail'),"message"=>"Duplicitní aktivní záznam");
        echo json_encode($response, JSON_PRETTY_PRINT);die;
}   } else {$_POST['Active']=0;$userName=null;}
$titleBefore = $_POST['TitleF'] ?? null;
if ($titleBefore=="") $titleBefore=null;
$titleAfter = $_POST['TitleP'] ?? null;
if ($titleAfter=="") $titleAfter=null;
$phone = $_POST['Phone'] ?? null;
if ($phone=="") $phone=null;
if ($userName=="") $userName=null;

$Func=23;if ($myFunc<=22) $Func=24;if ($myFunc<20) $Func=$_POST['Func'];
if (($Func=="")||(!is_numeric($Func))) $Func=23;

if ($userID==0) try { //vkládání
        $stmt = $conn->prepare("INSERT INTO RSP_USER (FirstName, LastName, TitleF, TitleP, Func, Phone, Mail, Login, Password, Active) "
             ." VALUES (?, ?, ?, ?, ?, ?, ?, ?, null, ?)");
        $stmt->execute([$firstName, $lastName, $titleBefore, $titleAfter, $Func, $phone, $email, $userName, $active]);
        $userID = $conn->lastInsertId(); //insert_id article; 

        $response = ['status' => 1, 'id' => $userID , 'message' => 'Osoba úspěšně zaregistrována'];
    } catch (PDOException $e) {
        $response = ['status' => 3, 'id' => "" , 'message' => 'Chyba při vkládání do databáze: ' . $e->getMessage()];
        echo json_encode($response, JSON_PRETTY_PRINT);die;

    }
else try {
        $stmt = $conn->prepare('UPDATE RSP_USER set FirstName=:fn, LastName=:ln, TitleF=:tf, TitleP=:tp, Func=:f, Phone=:p, Mail=:m, Login=:l, Active=:a where ID=:whereid');
        $stmt->execute(['fn' => $firstName, 'ln' => $lastName, 'tf' => $titleBefore, 'tp' => $titleAfter,
            'f' => $Func, 'p' => $phone, 'm' => $email, 'l' => $userName, 'a' => $active, 'whereid' => $userID]);

        $response = ['status' => 1, 'id' => $userID , 'message' => 'Osoba úspěšně upravena'];
    } catch (PDOException $e) {
        $response = ['status' => 3, 'id' => "" , 'message' => 'Chyba při přepisu databáze: ' . $e->getMessage()];
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }
if ($password!="") try {    
        $stmt = $conn->prepare('UPDATE RSP_USER set password=:pass where ID=:whereid');
        $stmt->execute(['pass' => password_hash($password, PASSWORD_DEFAULT), 'whereid' => $userID]);
    } catch (PDOException $e) {
        $response = ['status' => 3, 'id' => "" , 'message' => 'Chyba při zadání hesla: ' . $e->getMessage()];
        echo json_encode($response, JSON_PRETTY_PRINT);die;
    }

try {    
        $stmt = $conn->prepare('INSERT INTO `RSP_EVENT` (`Datum`, `Autor`, `Edition`, `Article`, `Type`, `Message`, `Data`, `Document`) '
                . 'VALUES (now(), :creator, NULL, NULL, 10, :note, :data, NULL)');
        $stmt->execute([ 'creator' => (($myID==0)?null:$myID), 'note' => $_POST["note"], 'data' => "{ID:".$userID."}"]);
    } catch (PDOException $e) {
        $response = ['status' => 3, 'id' => "" , 'message' => 'Chyba při logování: ' . $e->getMessage()];
    }

echo json_encode($response);
?>
