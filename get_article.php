<?php
    require_once("database.php"); /* подключение к базе */
    require_once("models/articles.php"); /* сама логика  */

    $link = db_connect(); /* записали в $link функцию которая подключается к базе, будем пользовать переменную */

    $article = articles_get($link, $_GET['id']); /* Вызываем функцию получения определенной
     статьи(из models\articles.php), где второй параметр $_GET['id'] получает с url'a id'шник статьи */
    /* Все про $_GET['id'] http://ru.stackoverflow.com/questions/245330/%D0%9F%D1%80%D0%B8%D0%BD%D1%86%D0%
    B8%D0%BF-%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D1%8B-get */
    /* Записали все это в переменную $article к которой будем обращаться из views */

    include("views/article.php"); /* подключили определенную страницу со статьей */
?>