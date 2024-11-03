<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/script.js"></script>
    <title>D.O.T.A.Z - rozcestník</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-blue fixed-top">
            <div class="container-fluid">
                <div class="col-sm-4 d-flex">
                    <a class="navbar-brand" href="index.php">
                        <img src="../grafika/logo-dotaz.svg" alt="Logo casopisu DOTAZ">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">O nás</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edition.php">Další edice</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <form class="d-flex" role="search" method="get" action="include/search.php">
                        <input class="form-control me-2" type="search" placeholder="Článek, autor, téma, ..." aria-label="Search">
                        <button class="btn btn-light-border" type="submit">Vyhledat</button>
                    </form>
                </div>

                <div class="col-sm-4 d-flex justify-content-end">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="include/logout.php">Odhlásit se</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="loginpage.php">Přihlásit se</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registerpage.php">Registrovat se</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>