<?php


require_once('templates/header.php');
require_once('lib/user.php');

$errors = [];
$messages = [];


if (isset($_POST['loginuser'])) {

    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {

        $_SESSION['user'] = ['email' => $user['email']];
        header('location: index.php');
    } else {
        $errors[] = 'email ou le mot de passe incorecte';

    }

}

?>
<h1>connexion</h1>

<?php foreach ($messages as $message) { ?>

    <div class="alert alert-success"> <?php echo $message; ?></div>

<?php } ?>
<?php foreach ($errors as $error) { ?>

    <div class="alert alert-danger"> <?php echo $error; ?></div>

<?php } ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="email">email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>


    <input type="submit" value="connexion" name="loginuser" class="btn btn-primary">

</form>

<?php

require_once('templates/footer.php');
?>
