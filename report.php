<?php
require 'vendor/autoload.php'; // Підключення PHPWord
require_once('../../config.php');
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

// Заголовок сторінки
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Генератор силабусу');
$PAGE->set_heading('Генератор силабусу');

// Функція для відображення форми
function display_customplugin_form() {
    echo '<div style="width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">';
    echo '<form method="post" action="">';
    echo '<div style="text-align: center; margin-bottom: 20px;"><h2>Форма для створення силабусу</h2></div>';

    // Загальні поля у вигляді таблиці
    echo '<table style="width: 100%;">';
    echo '<tr><td>Назва освітньої компоненти:</td><td><input type="text" name="educational_component" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Тип курсу:</td><td><input type="text" name="course_type" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Рівень вищої освіти:</td><td><input type="text" name="education_level" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Кількість кредитів/годин:</td><td><input type="text" name="credits_hours" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Семестр:</td><td><input type="text" name="semester" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Викладач:</td><td><input type="text" name="teacher" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Посилання на сайт:</td><td><input type="text" name="website_link" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Контактний телефон, месенджер:</td><td><input type="text" name="contact_phone" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Email викладача:</td><td><input type="text" name="teacher_email" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Методи викладання:</td><td><input type="text" name="teaching_methods" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '<tr><td>Форма контролю:</td><td><input type="text" name="assessment_form" style="width: 100%; margin-bottom: 10px;"></td></tr>';
    echo '</table>';

    // Форми додані нижче
    echo '<h3>Анотація до курсу</h3>';
    echo '<textarea name="course_annotation" style="width: 100%; margin-bottom: 10px;"></textarea><br>';

    echo '<h3>Мета та цілі курсу</h3>';
    echo '<textarea name="course_goals" style="width: 100%; margin-bottom: 10px;"></textarea><br>';

    echo '<h3>Компетентності та програмні результати навчання</h3>';
    echo '<textarea name="competencies" style="width: 100%; margin-bottom: 10px;"></textarea><br>';

    echo '<h3>Політика курсу</h3>';
    echo '<textarea name="course_policy" style="width: 100%; margin-bottom: 10px;"></textarea><br>';

    echo '<h3>Система оцінювання та вимоги</h3>';
    echo '<textarea name="assessment_requirements" style="width: 100%; margin-bottom: 10px;"></textarea><br>';

    echo '<h3>Критерії оцінювання та бали</h3>';
    echo '<textarea name="assessment_criteria" style="width: 100%; margin-bottom: 10px;"></textarea><br>';

    echo '<input type="submit" name="submit" value="Submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">';
    echo '</form>';
    echo '</div>';
}

// Перевірка, чи форма була надіслана
if(isset($_POST['submit'])) {
    // Створення документа
    $phpWord = new PhpWord();
    
    // Додавання тексту зі стилем для загальних полів форми
    $section = $phpWord->addSection();
    $section->addText('МІНІСТЕРСТВО ОСВІТИ І НАУКИ УКРАЇНИ', array('size' => 16, 'bold' => true, 'align' => Jc::CENTER));
    $section->addText('ХЕРСОНСЬКИЙ ДЕРЖАВНИЙ УНІВЕРСИТЕТ', array('size' => 16, 'bold' => true, 'align' => Jc::CENTER));
    $section->addText('СИЛАБУС ОСВІТНЬОЇ КОМПОНЕНТИ', array('size' => 16, 'bold' => true, 'align' => Jc::CENTER));

    $section->addText('Назва освітньої компоненти: ' . $_POST['educational_component']);
    $section->addText('Тип курсу: ' . $_POST['course_type']);
    $section->addText('Рівень вищої освіти: ' . $_POST['education_level']);
    $section->addText('Кількість кредитів/годин: ' . $_POST['credits_hours']);
    $section->addText('Семестр: ' . $_POST['semester']);
    $section->addText('Викладач: ' . $_POST['teacher']);
    $section->addText('Посилання на сайт: ' . $_POST['website_link']);
    $section->addText('Контактний телефон, месенджер: ' . $_POST['contact_phone']);
    $section->addText('Email викладача: ' . $_POST['teacher_email']);
    $section->addText('Методи викладання: ' . $_POST['teaching_methods']);
    $section->addText('Форма контролю: ' . $_POST['assessment_form']);
    
    // Додавання тексту зі стилем для форм анотації курсу, мети курсу та компетентностей
    $section->addText('Анотація до курсу: ' . $_POST['course_annotation'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Мета та цілі курсу: ' . $_POST['course_goals'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Компетентності та програмні результати навчання: ' . $_POST['competencies'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));

    // Додавання тексту зі стилем для інших форм
    $section->addText('Політика курсу: ' . $_POST['course_policy'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Система оцінювання та вимоги: ' . $_POST['assessment_requirements'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Критерії оцінювання та бали: ' . $_POST['assessment_criteria'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));

    // Збереження документу
    $filename = 'Силабус.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filename);

    // Надання документа користувачеві для завантаження
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($filename);
    unlink($filename); // Видалення файлу після завантаження
} else {
    // Форма не була надіслана
    // Заголовок сторінки
    $PAGE->set_pagelayout('standard');

    // Виведення заголовка сторінки
    echo $OUTPUT->header();

    // Виклик функції для відображення форми
    display_customplugin_form();

    // Виведення підвалу сторінки
    echo $OUTPUT->footer();
}
?>