<?php
require 'vendor/autoload.php'; // Підключення PHPWord
require_once('../../config.php');
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;

// Функція для відображення форми
function display_customplugin_form() {
    echo '<div style="width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">';
    echo '<form method="post" action="">';
    echo '<div style="text-align: center; margin-bottom: 20px;"><h2>Форма для створення силабусу</h2></div>';
    echo 'Назва освітньої компоненти: <input type="text" name="educational_component" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Тип курсу: <input type="text" name="course_type" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Рівень вищої освіти: <input type="text" name="education_level" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Кількість кредитів/годин: <input type="text" name="credits_hours" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Семестр: <input type="text" name="semester" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Викладач: <input type="text" name="teacher" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Посилання на сайт: <input type="text" name="website_link" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Контактний телефон, месенджер: <input type="text" name="contact_phone" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Email викладача: <input type="text" name="teacher_email" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Методи викладання: <input type="text" name="teaching_methods" style="width: 100%; margin-bottom: 10px;"><br>';
    echo 'Форма контролю: <input type="text" name="assessment_form" style="width: 100%; margin-bottom: 10px;"><br>';
    echo '<input type="submit" name="submit" value="Submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">';
    echo '</form>';
    echo '</div>';
}

// Перевірка, чи форма була надіслана
if(isset($_POST['submit'])) {
    // Створення документа
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Додавання тексту зі стилем для кожного поля форми
    $section->addText('Херсонський Державний Університет', array('bold' => true, 'size' => 16, 'align' => Jc::CENTER));
    $section->addText('Силабус', array('bold' => true, 'size' => 16, 'align' => Jc::CENTER));
    $section->addText('');

    $section->addText('Назва освітньої компоненти: ' . $_POST['educational_component'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Тип курсу: ' . $_POST['course_type'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Рівень вищої освіти: ' . $_POST['education_level'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Кількість кредитів/годин: ' . $_POST['credits_hours'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Семестр: ' . $_POST['semester'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Викладач: ' . $_POST['teacher'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Посилання на сайт: ' . $_POST['website_link'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Контактний телефон, месенджер: ' . $_POST['contact_phone'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Email викладача: ' . $_POST['teacher_email'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Методи викладання: ' . $_POST['teaching_methods'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));
    $section->addText('Форма контролю: ' . $_POST['assessment_form'], array('size' => 14, 'name' => 'Times New Roman'), array('align' => Jc::CENTER));

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
