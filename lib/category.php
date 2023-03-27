<?php
function getCategories(PDO $pdo){
$sql ='SELECT * FROM categories  '; //recupere tous les recette et les classe pars la plus recente
$query = $pdo ->prepare($sql);
$query -> execute();
return $query -> fetchAll();
}