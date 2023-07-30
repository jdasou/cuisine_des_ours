<?php

global $pdo;
require_once('templates/header.php');
require_once('lib/recipe.php');

$recipes = getRecipes($pdo, _HOME_RECIPES_LIMIT_);

?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="assets/images/b_logo.png" class="d-block mx-lg-auto img-fluid" alt="Logo Cuisinea" width="350"
             loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">La cuisine des ours <br> recette de cuisines</h1>
        <p class="lead">En tant qu'ancien cuisinier passionné, je souhaite maintenant partager mes talents culinaires
            avec le monde en proposant des recettes accessibles à tous. Explorez mon site pour découvrir des plats
            savoureux, des astuces pratiques et des idées créatives qui égayeront vos repas quotidiens.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="recettes.php" type="button" class="btn btn-primary btn-lg px-4 me-md-2">Voir nos recettes</a>
        </div>
    </div>
</div>


<div class="row">


    <?php
    foreach ($recipes as $key => $recipe) {
        include('templates/recipe_partial.php');


    } ?>

    <?php
    require_once('templates/footer.php');
    ?>






