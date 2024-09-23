<?php session_start(); ?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>D.O.T.A.Z - rozcestník</title>
</head>
<body>
<header>
    <menu>
        <ul>
            <li>Username</li>
            <li>Datum</li>
            <li><a href="loginpage.php">Přihlásit</a></li>
            <li><a href="registerpage.php">Registrace</a></li>
        </ul>
    </menu>
</header>

<main>
    <section class="hero">
        <h1>Vitejte</h1>
    </section>

    <section class="articles">
        <article>
            <img src="placeholder-article.png" alt="article">
            <h2>Nazev clanku</h2>
            <span>Autor:</span><span>Datum publikace</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia excepturi ullam itaque sit! Itaque eaque repudiandae voluptatum maiores modi aperiam voluptatem, eveniet, atque voluptates deleniti laudantium obcaecati molestias suscipit error.</p>
        </article>
    </section>
</main>

<footer>

</footer>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>