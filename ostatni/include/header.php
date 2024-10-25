<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <title>D.O.T.A.Z - rozcestník</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-blue fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../grafika/logo-dotaz.svg" height="30px" alt="Logo casopisu DOTAZ">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item <?php if(htmlentities($_GET["tag"]) == 'sci') echo "active" ?>">
                            <a class="nav-link" href="category.php?tag=sci">VĚDA</a>
                        </li> 
                        <li class="nav-item <?php if(htmlentities($_GET["tag"]) == 'tech') echo "active" ?>">
                            <a class="nav-link" href="category.php?tag=tech">TECHNIKA</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method="get" action="include/search.php">
                        <input class="form-control me-2" type="search" placeholder="Článek, autor, téma, ..." aria-label="Search">
                        <button class="btn btn-light-border" type="submit">Vyhledat</button>
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