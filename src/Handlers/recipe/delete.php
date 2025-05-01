<?php
// src/handlers/recipe/delete.php

require_once __DIR__ . '/../../db.php';

$pdo = getPDO();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: /');
exit;

