
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Recipe Book' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
        }
        header, footer {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            background: white;
            padding: 20px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>📖 Recipe Book</h1>
        <nav>
            <a href="/">Главная</a> |
            <a href="/index.php?route=create">Добавить рецепт</a>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        &copy; <?= date('Y') ?> Recipe Book
    </footer>
</body>
</html>
