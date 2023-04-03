<?php

function getRecipeByid( PDO $pdo, int $id){
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}
function getRecipeImage(string| null $image): string
{
    if ($image === null) {
        return _ASSETS_IMG_PATH_ . 'image-default.jpg';
    } else {
        return _RECIPES_IMG_PATH_ . $image;
    }
}

function getRecipes(PDO $pdo, int $limit = null){
    $sql ='SELECT * FROM recipes ORDER BY RAND() DESC '; //recupere tous les recette et les classe pars la plus recente et pour alleatoire mettre RAND() au lieu du id

    if ($limit){
        $sql .= ' LIMIT :limit ';
    }

    $query = $pdo ->prepare($sql);

    if ($limit){
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    $query -> execute();
   return $query -> fetchAll();
}

function saveRecipe(PDO $pdo, int $category, string $title, string $description, string $ingredients, string $instructions, string|null $image) {
    $sql = "INSERT INTO `recipes` (`id`, `category_id`, `title`, `description`, `ingredients`, `instructions`, `image`) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':category_id', $category, PDO::PARAM_INT);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);

    try {
        $query->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    return true;
}
