<?php
require_once('templates/header.php');
require_once('lib/user.php');
$errors = [];
$messages = [];
if (isset($_POST['addUser'])) {

    $res = addUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
    if ($res) {
        $messages[] = 'merci pour votre inscription';

    } else {
        $errors[] = 'une erreur c est produite';
        var_dump($res);

    }

}

?>

<h1>inscription</h1>

<?php foreach ($messages as $message) { ?>

    <div class="alert alert-success"> <?php echo $message; ?></div>

<?php } ?>
<?php foreach ($errors as $error) { ?>

    <div class="alert alert-danger"> <?php echo $error; ?></div>

<?php } ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="first_name">prenom</label>
        <input type="first_name" name="first_name" id="first_name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="last_name">nom</label>
        <input type="last_name" name="last_name" id="last_name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="email">email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mb-3">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>


    <input type="submit" value="inscription" name="addUser" class="btn btn-primary">

</form>

<?php

require_once('templates/footer.php');
?>
