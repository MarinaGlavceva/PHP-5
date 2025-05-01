<?php


require_once __DIR__ . '/../../db.php';

$pdo = getPDO();
$errors = [];

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
$stmt->execute([':id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    die('Рецепт не найден');
}


$title = $recipe['title'];
$category = $recipe['category'];
$ingredients = $recipe['ingredients'];
$description = $recipe['description'];
$tags = $recipe['tags'];
$steps = $recipe['steps'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $category = (int)$_POST['category'];
    $ingredients = trim($_POST['ingredients']);
    $description = trim($_POST['description']);
    $tags = trim($_POST['tags']);
    $steps = trim($_POST['steps']);

    if ($title === '') {
        $errors['title'] = 'Введите название рецепта';
    }
    if ($category <= 0) {
        $errors['category'] = 'Выберите категорию';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE recipes SET title = :title, category = :category, ingredients = :ingredients,
                               description = :description, tags = :tags, steps = :steps WHERE id = :id");
        $stmt->execute([
            ':title' => $title,
            ':category' => $category,
            ':ingredients' => $ingredients,
            ':description' => $description,
            ':tags' => $tags,
            ':steps' => $steps,
            ':id' => $id,
        ]);
        header('Location: /?route=recipe&id=' . $id);
        exit;
    }
}


$categories = $pdo->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);


ob_start();
require __DIR__ . '/../../../templates/recipe/edit.php';
$content = ob_get_clean();
require __DIR__ . '/../../../templates/layout.php';

