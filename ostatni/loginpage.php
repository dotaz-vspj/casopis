<?php include 'include/session_open.php'; ?>
<?php include 'include/header.php'; ?>

<?php
// show error message if there is any
if (isset($_SESSION['error'])) {
    echo '<p>' . htmlspecialchars($_SESSION['error']) . '</p>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['user']['session_tag'])) {
    echo '<p>Session Hash: ' . htmlspecialchars($_SESSION['user']['session_tag']) . '</p>';
}
?>

<div class="container" style="padding-top:150px">
    <div class="row justify-content-center">
        <div class="col-sm-6 p-5 text-center login-register-form m-5">
            <form action="include/login.php" method="post">
            <div class="form-group">
                <label class="m-2" id="username">Přihlašovací jméno</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label class="m-2" id="password">Heslo</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div style="height:2em;"></div>
            <div class="form-group">
                <button class="btn btn-size-mid box-btn btn-dark" type="submit">Přihlásit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>