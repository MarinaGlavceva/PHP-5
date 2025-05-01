<?php
/**
 * public/index.php
 * Единая точка входа - маршрутизатор приложения
 */

require_once __DIR__ . '/../src/helpers.php';

// Определяем маршрут (по умолчанию главная страница)
$route = $_GET['route'] ?? 'index';

// Простая маршрутизация
switch ($route) {
    case 'create':
        require __DIR__ . '/../src/handlers/recipe/create.php';
        break;
    case 'edit':
        require __DIR__ . '/../src/handlers/recipe/edit.php';
        break;
    case 'delete':
        require __DIR__ . '/../src/handlers/recipe/delete.php';
        break;
    case 'recipe':
        require __DIR__ . '/../templates/recipe/show.php';
        break;
    default:
        // Главная страница (список рецептов)
        require __DIR__ . '/../templates/index.php';
}
