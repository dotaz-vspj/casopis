<?php include 'include/session_open.php'; 
$sql = 'SELECT U.Func, CONCAT(case when TitleF is null then "" else CONCAT(TitleF," ") end,FirstName," ",LastName,case when TitleP is null then "" else CONCAT(", ",TitleP) end) fullName FROM `RSP_USER` U '.
       "where Active=1 and Func in (11,12,13) order by Func, Lastname, Firstname";
$result = $conn->query($sql);
// if ($result->rowCount() == 0) {Header("location:index.php");die;}
?>
<?php include 'include/header.php'; ?>


<main>
  <div id="container" class="d-flex flex-column justify-content-center align-items-center h-100">
    <div class="w-50" id="contend">
      <div class="mb-5">
      <h1>O nás</h1>
      <p>Jsme studenti II. ročníku kombinovaného studia, a tvoříme team "Dotaz", kde v rámci předmětu Řízení Softwarových systémů pod vedením doc. Dr. Ing. Jana Voráčka, CSc. připravujeme projekt vědeckého časopisu. Projekt je veden jako skupinová seminární práce, a popravdě se nepočítá s jeho plným dokončením, což nám ovšem přijde škoda, neb jsme se na tom docela vyblbli (a občas i trochu zhádali). </p>
      </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Redakční tým</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" >Kontakty</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false" >Podmínky podání</button>
            <button class="nav-link" id="nav-map-tab" data-bs-toggle="tab" data-bs-target="#nav-map" type="button" role="tab" aria-controls="nav-map" aria-selected="false" >Mapa</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" >
          
<?php $U=$result->fetchObject(); ?>
          <ul>
          <h4>Šéfredaktor</h4>
            <li><?php echo $U->fullName; ?></li>
          </ul>
          
          <ul>
          <h4>Odpovědný redaktor</h4>
<?php $U=$result->fetchObject();
while ($U && ($U->Func<=12)) { ?>
            <li><?php echo $U->fullName; ?></li>
<?php $U=$result->fetchObject(); }  ?>
          </ul>
          
          <ul>
          <h4>Redakční rada</h4>
<?php if ($U) { ?>          
            <li><?php echo $U->fullName; ?></li>
<?php } else { ?>         
            <li>Osoby nejsou registrovány, zadejte je pomocí administračního rozhraní</li>
<?php } ?>         
<?php while($U=$result->fetchObject()) { ?>          
            <li><?php echo $U->fullName; ?></li>
<?php } ?>         
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" >
            
            <ul>
            <h4>Kontakty</h4>
                <li><strong>Telefon:</strong> +420 123 456 789</li>
                <li><strong>Email:</strong> jan.novak@vse.cz</li>
            </ul>
            <ul>
                <li><strong>Telefon:</strong> +420 987 654 321</li>
                <li><strong>Email:</strong> petra.novotna@vse.cz</li>
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" >
       
            <ol>
            <h4>Podmínky podání</h4>
                <li>Podání článku musí být provedeno elektronicky prostřednictvím našeho webového formuláře.</li>
                <li>Článek musí být originální, dosud nepublikovaný.</li>
                <li>Všechny podání budou posuzována recenzenty z oboru.</li>
                <li>Maximální délka článku je 5000 slov včetně příloh.</li>
            </ol>
        </div>
        
        <div class="tab-pane fade d-flex flex-column " id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab" >
            
            <div class="d-flex gap-5">
            <div>
            
            <ul>
            <h4>Mapa</h4>
            <li><strong>Vysoká škola polytechnická Jihlava</strong></li>
            <li>Tolstého 1556/16 </li>
            <li>58601 Jihlava</li>
            </ul>
            </div>
            <iframe style="border:none" src="https://frame.mapy.cz/s/cafuvarebu" width="400" height="280" frameborder="0"></iframe>
            
        </div>
    </div>
  </div>
  </main>
  <script>//Jana Aboutus - nemazat
$(document).ready(function() {

$('main.nav-link').on('click', function() {
    
    $('main.nav-link').css({
        'background-color': '#12146a',
        'color': 'white'
    });
    $('main.tab-pane').css({
        'background-color': '#12146a',
        'color': 'white'
    });
  
    $(this).css({
        'background-color': '#f0f0f0',
        'color': 'black',
        
    });
   
    var targetTab = $(this).attr('data-bs-target');
    $(targetTab).css({
        'background-color': '#12146a',
        'color': 'white'
    });
});
})</script>
<?php include 'include/footer.php'; ?>





