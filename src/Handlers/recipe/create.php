
<?php
// src/handlers/recipe/create.php

require_once __DIR__ . '/../../db.php';

$pdo = getPDO();
$errors = [];

$title = '';
$category = '';
$ingredients = '';
$description = '';
$tags = '';
$steps = '';


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
        $stmt = $pdo->prepare("INSERT INTO recipes (title, category, ingredients, description, tags, steps) 
                               VALUES (:title, :category, :ingredients, :description, :tags, :steps)");
        $stmt->execute([
            ':title' => $title,
            ':category' => $category,
            ':ingredients' => $ingredients,
            ':description' => $description,
            ':tags' => $tags,
            ':steps' => $steps,
        ]);
        header('Location: /');
        exit;
    }
}


$categories = $pdo->query("SELECT id, name FROM categories")->fetchAll(PDO::FETCH_ASSOC);


ob_start();
require __DIR__ . '/../../../templates/recipe/create.php';
$content = ob_get_clean();
require __DIR__ . '/../../../templates/layout.php';
