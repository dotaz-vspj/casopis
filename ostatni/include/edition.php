<!-- UPDATE TT 2024-11-06 -->
<!-- UPDATE used session_open: <php include 'include/session_open.php'; ?> - defines $myID#$img_dir-->
<!-- UPDATE used img-dir: <php echo "{$img_dir}picture{$A->ID}";?>.png -->
<!-- UPDATE removed gotoarticle: window.location.href = 'article.php?id=<php echo $A->ID?> -->
<!-- FIX used EID (duplicity in SQL): SELECT *, E.ID as EID from -->
<!-- FIX used $myID instead of $myFunc: $sql = "SELECT Func from `RSP_USER` U where ID=".$myID; -->
<?php include 'include/session_open.php'; ?>
<?php
$sql = "SELECT *, E.ID as EID from `RSP_EDITION` E left join `RSP_USER` U on E.Redactor=U.ID".
        (($myFunc>22)?" where E.Published is not null and E.Published<now()":"");
$result = $conn->query($sql);
?>
<?php include 'include/header.php'; ?>
<div class="container" style="padding-top: 120px;">
            <?php while ($E=$result->fetchObject()) {?>
            <div class="row mb-2 justify-content-center">
                <div class="col-sm-2 d-flex">
                    <img class="card-image" width=200 height=150 onclick="{window.location.href = 'index.php?id=<?php echo $E->EID?>';return true;}" src="<?php echo "{$img_dir}picture{$E->ID}";?>.png"/>
                </div>
                <div class="col-sm-6">
                    <h2><strong><?php echo $E->Title;?></strong></h2>
                    <h3>Redaktor:
                        <span class="author">
                            <?php echo $E->LastName.", ".$E->TitleF." ".$E->FirstName." ".$E->TitleP." ";?>
                        </span></h3>
                    <h4>Vydáno dne:
                        <span class="published">
                            <?php 
                                if (($E->Published == "" )||(strtotime($E->Published) === false)) {
                                    echo '"' . $E->Published . '"';
                                } else {
                                    echo $E->Published;
                                }
                            ?>
                    </span></h4>
                    <p class="text-justify"><?php echo $E->Thema;?></p>
                </div>
            </div>
            <?php }?>
    </div>

<?php include 'include/footer.php'; ?>
