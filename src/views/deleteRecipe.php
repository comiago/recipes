<?php
include_once('../models/Database.php');
include_once('../models/Recipe.php');
include_once('../models/Ingredient.php');
include_once('../models/Step.php');

$db = new Database();
$pdo = $db->connect();
$recipeModel = new Recipe($pdo);
$ingredientModel = new Ingredient($pdo);
$stepsModel = new Step($pdo);

if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    foreach ($recipeModel->getIngredientsByRecipe($recipeId) as $ingredient) {
        $ingredientModel->unlinkIngredient($ingredient['idIR']);
    }
    $stepsModel->deleteStepsByRecipe($recipeId);
    $recipeModel->deleteRecipe($recipeId);
}
header('Location: ../../public/dashboard.php');
exit;
?>
