<?php
require_once('../../config.php');
require_login(); // Перевірка, чи користувач увійшов в систему

// Перевірка ролі користувача
function check_user_role() {
    global $USER;
    if (!is_siteadmin() && !in_array('manager', $USER->roles) && !in_array('course_author', $USER->roles) && !in_array('teacher', $USER->roles)) {
        return false; // Користувач не має відповідних ролей
    }
    return true; // Користувач має відповідні ролі
}

// Перевірка доступу до сторінки
if (!check_user_role()) {
    print_error('accessdenied', '', $CFG->wwwroot); // Виведення повідомлення про відмову в доступі
}

echo "Ви маєте доступ до цієї сторінки!";
?>
