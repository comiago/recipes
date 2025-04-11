<?php
require_once('../src/models/Recipe.php');
require_once('../src/models/Role.php');
require_once('../src/models/Ingredient.php');
require_once('../src/models/Database.php');

class DashboardController
{
    private $pdo;
    private $recipeModel;
    private $roleModel;
    private $ingredientModel;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
        $this->recipeModel = new Recipe($this->pdo);
        $this->roleModel = new Role($this->pdo);
        $this->ingredientModel = new Ingredient($this->pdo);
    }

    public function handle($page)
    {
        switch ($page) {
            case 'recipe':
                if (isset($_GET['id'])) {
                    $data = $this->recipeModel->getRecipeById($_GET['id']);
                } else {
                    $data = null;
                }
                $view = 'recipe.php';
                break;

            case 'recipes':
                if ($this->roleModel->getRoleById($_SESSION['role'])['name'] == 'Admin') {
                    $data = $this->recipeModel->getRecipesByUserId($_SESSION['user_id']);   
                } else {
                    $data = $this->recipeModel->getAllRecipes();
                }
                $view = 'recipes.php';
                break;

            case 'ingredients':
                $data = $this->ingredientModel->getAllIngredients();
                $view = 'ingredients.php';
                break;

            case 'newRecipe':
                $data = [];
                $view = 'newRecipe.php';
                break;

            case 'editRecipe':
                $data = [];
                $view = 'editRecipe.php';
                break;

            case 'settings':
                $data = [];
                $view = 'settings.php';
                break;

            case 'home':
            default:
                $data = [
                    'ricette' => count($this->recipeModel->getRecipesByUserId($_SESSION['user_id'])),
                    'ingredients' => count($this->ingredientModel->getAllIngredients()),
                    'ultime' => array_column(
                        $this->recipeModel->getRecipesByUserId($_SESSION['user_id']),
                        'title'
                    )
                ];
                $view = 'home.php';
                break;
        }

        return ['view' => $view, 'data' => $data];
    }
}
