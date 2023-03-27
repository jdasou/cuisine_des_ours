<?php


require_once('lib/recipe.php');
require_once('templates/header.php');
require_once('lib/tools.php');

$id = (int)$_GET['id'];
$recipe =getRecipeByid($pdo,$id);
if ($recipe){

    $ingredients = lineToArray($recipe['ingredients']);
    $instructions = lineToArray($recipe['instructions']);

?>
<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="<?=getRecipeImage($recipe['image']);?>" class="d-block mx-lg-auto img-fluid" alt="<?=$recipe['title'];?>" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=$recipe['title'];?></h1>
        <p class="lead"><?=$recipe['description'] ;?> </p>
    </div>
</div>


<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <h2>Ingredient</h2>
    <ul class="list-group">
        <?php
        foreach ($ingredients as $key => $ingredient){ ?>
            <li class="list-group-item"> <?=  $ingredient;?></li>
        <?php }
        ?>
    </ul>



</div>
<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <h2>instruction</h2>
    <ul class="list-group">
        <?php
        foreach ($instructions as $key => $instruction){ ?>
            <li class="list-group-item"> <?=  $instruction;?></li>
        <?php }
        ?>
    </ul>
</div>
<?php }
    else { ?>
        <div class="row text-center">
            <h1>Recette Introuvable 🧸 </h1>
        </div>


<?php }

require_once('templates/footer.php');
?>



