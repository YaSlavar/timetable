<?php
/**
 * Created by PhpStorm.
 * User: yasla
 * Date: 01.09.2019
 * Time: 21:39
 */

global $db;

$path_to_db_file = "table.db";

$last_upload_date = date('d.m.Y', filemtime($path_to_db_file));

$db = new SQLite3($path_to_db_file);


// Глобальные переменные

$title = "Расписание РТУ МИРЭА"; # Заголовок сайта

$start_day = "10.02.2020"; # Первый день семестра, День должен быть понедельником!
$delta = 6; # Поправка на количество недель, для того, чтобы первая неделя семестра была первой.
$semester_count = 2; # 1 - четный семестр, 2 - нечетный семестр
$first_course_year = 2019; # Год поступления первого курса в текущем учебном году.


$group_postfix = array(
    "bac" => array(
        "БО",
        "СО"
    ),
    "mag" => array(
        "МО"
    )
);

$group_description = array(
    "bac" => "Бакалавриат / Специалитет",
    "mag" => "Магистратура"
);

# Количество недель в семестре
$week_count_array = array(
    "semester" => array(  # тип расписания
        "bac" => array(  # тип группы
            1 => array(  # четность семестра
                1 => 16,
                2 => 16,
                3 => 16,
                4 => 16,  # номер курса => количество недель в семестре
            ),
            2 => array(
                1 => 16,
                2 => 16,
                3 => 16,
                4 => 8
            )
        ),
        "mag" => array(  # тип группы
            1 => array(  # четность семестра
                1 => 17,
                2 => 17  # номер курса => количество недель в семестре
            ),
            2 => array(
                1 => 17,
                2 => 14
            )
        )
    ),
    "zach" => array(
        "bac" => array(  # тип группы
            1 => array(  # четность семестра
                1 => 1,
                2 => 1,
                3 => 1,
                4 => 1  # номер курса => количество недель в зачетной неделе
            ),
            2 => array(
                1 => 1,
                2 => 1,
                3 => 1,
                4 => 1
            )
        ),
        "mag" => 0
    ),
    "exam" => array(
        "bac" => array(  # тип группы
            1 => array(  # четность семестра
                1 => 5,
                2 => 5,
                3 => 5,
                4 => 5,  # номер курса => количество недель в сессии
            ),
            2 => array(
                1 => 5,
                2 => 5,
                3 => 5,
                4 => 2
            )
        ),
        "mag" => array(  # тип группы
            1 => array(  # четность семестра
                1 => 4,
                2 => 4,
                3 => 4,
                4 => 4,  # номер курса => количество недель в сессии
            ),
            2 => array(
                1 => 2,
                2 => 0
            )
        )
    )
);

$etalon_group = "БНБО-02-16"; # Группа отображаемая по умолчанию

$email_to_feedback = "ya.slavar@yandex.ru";


// Сообщения на сайте

$notification = json_encode(array(
    "is_show" => true,
    "key" => "05_02_update",
    "header" => "Добавлено расписание весеннего семестра",
    "message" => "Здравствуйте, уважаемые студенты! <br><br>
                    Добавлено расписание на весенний семестр. <br>
                    Обращаю Ваше внимание, что первые 2-3 недели после начала семестра возможны накладки и корректировки расписания. <br>
                    Постараюсь как можно чаще обновлять расписание на этом сайте.
                    <br>
                    --<br>
                    С уважением, Вячеслав.
                    <br><br>
                    Последнее обновление расписания: " . $last_upload_date . "",
    "date" => "05.02.2020"
));

$version = 36; # Версия