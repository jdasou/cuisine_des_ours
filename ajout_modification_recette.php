<?php

if (isset($_SESSION['user'])){
    header('location: login.php');

}


require_once('lib/recipe.php');
require_once('templates/header.php');
require_once('lib/tools.php');
require_once('lib/category.php');




$errors =[];
$messages= [];
$recipe = [
        'title'=>'',
        'description'=>'',
        'ingredients'=>'',
        'instructions'=>'',
        'category_id'=>'',
];
$categories =getCategories($pdo);

if (isset($_POST['saveRecipe'])) {
    $fileName = null;
//si un fichier a été envoyer
    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') {
        //la methode getimagesize vas retourner false si le fichier  n'est pas une image
        $checkImage = getimagesize($_FILES['file']['tmp_name']);

        if ($checkImage !== false) {
            // si c'est une image on traite
            $fileName = uniqid() . '-' . slugify($_FILES['file']['name']);

            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_ .$fileName);

        }
        else {
            //sinon on affiche un message d'erreur
            $errors[] = 'le fichier doit etre une image';

        }
    }

     if (!$errors){
         $res = saveRecipe($pdo, intval( $_POST['category']), $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);



         if ($res) {
             $messages[] = 'la recette a bien été sauvegarder';

         } else {
             $errors[] = ' la recette n\'a pas été sauvedarder ';
         }
     }
    $recipe= [
        'title'=>$_POST['title'],
        'description'=>$_POST['description'],
        'ingredients'=>$_POST['ingredients'],
        'instructions'=>$_POST['instructions'],
        'category_id'=>$_POST['category'],
    ];


}
?>

<h1>Ajouter une recette</h1>

<?php foreach ($messages as $message){?>

    <div class="alert alert-success"> <?php echo $message; ?></div>

<?php } ?>
<?php foreach ($errors as $error){?>

    <div class="alert alert-danger"> <?php echo $error; ?></div>

<?php } ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title">titre</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $recipe['title'];?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea  name="description" id="description" cols="30" rows="5" class="form-control"><?php echo $recipe['description'];?></textarea>
    </div> 
    <div class="mb-3">
        <label for="ingredients" class="form-label">ingredients</label>
        <textarea  name="ingredients" id="ingredients" cols="30" rows="5" class="form-control"><?php echo $recipe['ingredients'];?></textarea>
    </div> 
    <div class="mb-3">
        <label for="instructions" class="form-label">instructions</label>
        <textarea  name="instructions" id="instructions" cols="30" rows="5" class="form-control"><?php echo $recipe['instructions'];?></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">categorie</label>
        <select name="category" id="category" class="form-select">
        <?php foreach ($categories as $category){ ?>
            <option value="<?php echo $category['id'] ;?>" <?php if ($recipe['category_id'] == $category['id']){ echo 'selected="selected"';} ?>>  <?php echo $category['name'] ;?></option>

            <?php } ?>



    </div>
    <div class="mb-3">
    <label for="file" class="form-label">image</label>
    <input type="file" name="file" id="file" >
    </div>
    <input type="submit" value="enregistrer" name="saveRecipe" class="btn btn-primary">

</form>

<?php

require_once('templates/footer.php');
?>





