<?php
/**
 * templates/index.php
 * Главная страница - отображает 2 последних рецепта из базы данных
 */

require_once __DIR__ . '/../src/db.php';

$pdo = getPDO();

// Достаём 2 последних рецепта
$stmt = $pdo->query("SELECT recipes.*, categories.name AS category_name 
                     FROM recipes 
                     JOIN categories ON recipes.category = categories.id
                     ORDER BY created_at DESC 
                     LIMIT 2");
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Буферизация для layout
ob_start();
?>

<?php if (empty($recipes)): ?>
    <p>Пока нет ни одного рецепта. Добавьте свой первый рецепт!</p>
<?php else: ?>
    <h2>Последние рецепты:</h2>
    <?php foreach ($recipes as $recipe): ?>
        <h3><?= htmlspecialchars($recipe['title']) ?></h3>
        <p><strong>Категория:</strong> <?= htmlspecialchars($recipe['category_name']) ?></p>
        <p><strong>Ингредиенты:</strong> <?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
        <p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
