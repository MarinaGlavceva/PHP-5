 
<?php

/**
 * Очистка и экранирование данных формы.
 *
 * @param string|null $value Значение, которое нужно очистить.
 * @return string Очищенное значение.
 */
function cleanInput($value) {
    return htmlspecialchars(trim($value ?? ''));
}

/**
 * Проверка наличия обязательного поля.
 *
 * @param string $value Значение поля.
 * @return bool true, если пустое; false, если заполнено.
 */
function isRequired($value) {
    return trim($value) === '';
}

/**
 * Показ ошибки рядом с полем.
 *
 * @param array $errors Массив ошибок.
 * @param string $field Имя поля.
 * @return string HTML ошибки.
 */
function showError($errors, $field) {
    return isset($errors[$field]) ? '<p style="color:red;">' . $errors[$field] . '</p>' : '';
}

/**
 * Пагинация: получение текущей страницы.
 *
 * @return int Номер страницы (по умолчанию 1).
 */
function getCurrentPage() {
    return isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
}

/**
 * Перенаправление на страницу.
 *
 * @param string $url URL для перехода.
 */
function redirect($url) {
    header("Location: $url");
    exit;
}
