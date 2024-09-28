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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">D.O.T.A.Z</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Všechny články</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Věda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Technika</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Článek, autor, téma, ..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Vyhledat</button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="loginpage.php">Přihlásit se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registerpage.php">Registrovat se</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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