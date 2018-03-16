<meta charset="utf-8">
<?php
error_reporting(E_ALL); /* показывать все ошибки */

    require_once("database.php"); /* подключение к базе */
    require_once("models/articles.php"); /* сама логика */

    $link = db_connect(); /* записали в  $link функцию которая подключается к базе, будем пользовать переменную */
    $articles = articles_all($link); /* Полученные статьи(все) из массива записали в переменную, из views будем
    к ней обращаться */

    include("views/articles.php"); /* Подключили главную страницу на которой все статьи */
?>
