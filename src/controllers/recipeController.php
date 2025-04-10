<?php
include('../models/Database.php');
include('../models/Recipe.php');
include('../models/Ingredient.php');
include('../models/Step.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    include_once('../models/Database.php');
    include_once('../models/Recipe.php');
    include_once('../models/Ingredient.php');
    include_once('../models/Step.php');
    session_start();

    $controller = new RecipeController();

    switch ($_POST['action']) {
        case 'create':
            $controller->create();
            break;
    }
}

class RecipeController {
    
    // Mostra la dashboard con tutte le ricette dell'utente
    public function index($userId) {
        $db = new Database();
        $conn = $db->connect();
        
        $recipeModel = new Recipe($conn);
        $recipes = $recipeModel->getRecipesByUser($userId);
        
        include('../views/dashboard.php');
    }

    // Aggiungi una nuova ricetta
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $amount = $_POST['amount']; // Assicurati di passare anche l'importo se necessario
            $ingredients = $_POST['ingredients']; // Array di ingredienti
            $steps = $_POST['steps']; // Array di passaggi

            $db = new Database();
            $conn = $db->connect();

            $recipeModel = new Recipe($conn);
            $ingredientModel = new Ingredient($conn);
            $stepModel = new Step($conn);

            // Aggiungi la ricetta
            $recipeId = $recipeModel->addRecipe($title, $description, $amount, $_SESSION['user_id']);

            // Aggiungi ingredienti
            foreach ($ingredients as $ingredient) {
                $name = ucwords(strtolower(trim($ingredient['name'])));
                $ingredientId = $ingredientModel->addIngredient($name, $ingredient['amount'], $recipeId);
            }

            // Aggiungi passaggi
            foreach ($steps as $step_number => $step_desc) {
                $stepModel->addStep($step_number, $step_desc['description'], $recipeId);
            }
            
            header('Location: ../../public/dashboard.php');
            exit;
        }

        include('../views/add_recipe.php');
    }

    // Modifica una ricetta esistente
    public function edit($recipeId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $ingredients = $_POST['ingredients']; // Array di ingredienti
            $steps = $_POST['steps']; // Array di passaggi

            $db = new Database();
            $conn = $db->connect();

            $recipeModel = new Recipe($conn);
            $ingredientModel = new Ingredient($conn);
            $stepModel = new Step($conn);

            // Modifica la ricetta
            $recipeModel->updateRecipe($recipeId, $title, $description);

            // Modifica gli ingredienti e i passaggi
            $recipeModel->clearIngredients($recipeId);
            foreach ($ingredients as $ingredient) {
                $ingredientId = $ingredientModel->addIngredient($ingredient['name'], $ingredient['amount']);
                $recipeModel->linkIngredientToRecipe($ingredientId, $recipeId);
            }

            $recipeModel->clearSteps($recipeId);
            foreach ($steps as $step_number => $step_desc) {
                $stepModel->addStep($step_number, $step_desc, $recipeId);
            }

            header('Location: dashboard.php');
            exit;
        }

        // Recupera la ricetta e i dati per modificarla
        $db = new Database();
        $conn = $db->connect();

        $recipeModel = new Recipe($conn);
        $ingredientModel = new Ingredient($conn);
        $stepModel = new Step($conn);

        $recipe = $recipeModel->getRecipeById($recipeId);
        $ingredients = $ingredientModel->getIngredientsByRecipe($recipeId);
        $steps = $stepModel->getStepsByRecipe($recipeId);

        include('../views/edit_recipe.php');
    }
    
    // Elimina una ricetta
    public function delete($recipeId) {
        $db = new Database();
        $conn = $db->connect();
        
        $recipeModel = new Recipe($conn);
        $recipeModel->deleteRecipe($recipeId);
        
        header('Location: dashboard.php');
        exit;
    }
}
?>
