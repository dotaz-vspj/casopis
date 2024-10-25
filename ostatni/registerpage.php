<?php session_start(); ?>
<?php include 'include/header.php'; ?>

<?php if(!empty($_SESSION['error'])) echo $_SESSION['error']; ?>
<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 p-5 text-center login-register-form m-5">
            <form action="include/register.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="m-2" id="username">Přihlašovací jméno</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="email" required="required">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="password" required="required">Heslo</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="password_confirm" required="required">Potvrzení hesla</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="m-2" id="first_name">Jméno</label>
                            <input type="text" class="form-control" id="first_name" name="first_name">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="last_name">Příjmení</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="title_f">Titul před jménem</label>
                            <input type="text" class="form-control" id="title_f" name="title_f">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="title_p">Titul za jménem</label>
                            <input type="text" class="form-control" id="title_p" name="title_p">
                        </div>
                        <div class="form-group">
                            <label class="m-2" id="phone">Telefon</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <input type="hidden" id="function" name="function" value="1">
                        <input type="hidden" id="active" name="active" value="1">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-size-mid box-btn btn-dark" type="submit">Registrovat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'include/footer.php'; ?>