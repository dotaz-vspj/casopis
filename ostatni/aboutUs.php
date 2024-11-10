<?php session_start(); ?>
<?php include 'include/header.php'; ?>

<main>
  <div id="container" class="d-flex flex-column justify-content-center align-items-center h-100">
    <div class="w-50" id="contend">
      <div class="mb-5">
      <h1>O nás</h1>
      <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque possimus minus dignissimos itaque accusantium illo doloremque assumenda! Aperiam asperiores fugit illo commodi error expedita deserunt? Sit ex cumque adipisci repudiandae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil architecto ipsam error quos laboriosam eum excepturi aliquid fuga accusamus fugiat! Temporibus odio non modi ipsam est laudantium corporis, deserunt eaque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam optio labore aut recusandae, cumque aspernatur asperiores voluptate dolore maxime cupiditate vero dicta, repellendus laudantium? Architecto autem magnam beatae distinctio tenetur. lorem </p>
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
          <h4>Šéfredaktor</h4>
          <ul>
            <li><strong>Titul jméno přijmení titul</strong> - univezita</li>
          </ul>
          <h4>Redakční rada</h4>
          <ul>
            <li><strong>Titul jméno přijmení titul</strong> - univezita</li>
            <li><strong>Titul jméno přijmení titul</strong> - univezita</li>
            <li><strong>Titul jméno přijmení titul</strong> - univezita</li>
            <li><strong>Titul jméno přijmení titul</strong> - univezita</li>
          </ul>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" >
            <h4>Kontakty</h4>
            <ul>
                <li><strong>Telefon:</strong> +420 123 456 789</li>
                <li><strong>Email:</strong> jan.novak@vse.cz</li>
            </ul>
            <ul>
                <li><strong>Telefon:</strong> +420 987 654 321</li>
                <li><strong>Email:</strong> petra.novotna@vse.cz</li>
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" >
            <h4>Podmínky podání</h4>
            <ol>
                <li>Podání článku musí být provedeno elektronicky prostřednictvím našeho webového formuláře.</li>
                <li>Článek musí být originální, dosud nepublikovaný.</li>
                <li>Všechny podání budou posuzována recenzenty z oboru.</li>
                <li>Maximální délka článku je 5000 slov včetně příloh.</li>
            </ol>
        </div>
        
        <div class="tab-pane fade d-flex flex-column justify-content-center align-items-center " id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab" >
            
            <div class="d-flex gap-5">
            <div>
            <h4>Mapa</h4>
            <p><strong>Vysoká škola polytechnická</strong></p>
            <p>Tolstého 1556/16 </p>
            <p>58601 Jihlava</p>
            </div>
            <iframe style="border:none" src="https://frame.mapy.cz/s/fabagugaru" width="400" height="280" frameborder="0"></iframe>
            
        </div>
    </div>
  </div>
  </main>
  
<?php include 'include/footer.php'; ?>





