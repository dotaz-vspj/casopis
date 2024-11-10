function gotoarticle(id) {
    window.location.href = "article.php?id=" + id;
}

$(document).ready(function() {
  // Přepnutí aktivní záložky při kliknutí
  $('main.nav-link').on('click', function() {
      // Odebere aktivní styl ze všech záložek a obsahu
      $('main.nav-link').css({
          'background-color': '#7473a7',
          'color': 'white'
      });
      $('main.tab-pane').css({
          'background-color': '#7473a7',
          'color': 'white'
      });

      // Zvýrazní kliknutou záložku
      $(this).css({
          'background-color': '#12146a',
          'color': 'white'
      });

      // Najde odpovídající obsah a zvýrazní ho
      var targetTab = $(this).attr('data-bs-target');
      $(targetTab).css({
          'background-color': '#12146a',
          'color': 'white'
      });
  });
});
  