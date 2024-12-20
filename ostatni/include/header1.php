<!DOCTYPE html>
<!-- UPDATE TT 2024-11-06 -->
<!-- UPDATE used img-dir: <php echo "{$img_dir}";>logo-dotaz.svg -->
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 </script>

    <script src="public/js/script.js"></script>
    <title>D.O.T.A.Z - rozcestník</title>
</head>
<body onclick="document_onClick(this)">
    <header>
        <nav class="navbar navbar-expand-lg bg-blue fixed-top">
            <div id="menuMain" class="container-fluid">
                <div class="col-sm-4 d-flex">
                    <a class="navbar-brand" href="index.php">
                        <img src="<?php echo "{$img_dir}";?>logo-dotaz.svg" alt="Logo casopisu DOTAZ">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">O nás</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edition.php">Další edice</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-4">
    <form class="d-flex search-container" role="search" onsubmit="return false;">
        <input id="search" name="query" class="form-control me-2" type="search" placeholder="Vyhledávejte podle článků nebo autorů..." aria-label="Search" autocomplete="off" oninput="search_onInput(this)">
        <div id="suggestions" class="suggestions-list"></div>
    </form>
</div>

                <div class="col-sm-4 d-flex justify-content-end">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php">Profil</a>
                            </li>
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
    