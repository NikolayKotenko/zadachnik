<?php
    /* Вывод всех статей (2)*/
    function articles_all($link) /* на вход функция articles_all будет принимать подключение к базе $link */
    {
        //Запрос.
        $query = "SELECT * FROM articles ORDER BY id DESC"; /* Выбрать все колонки из таблицы articles и
            отсортировать по колонке id в убывающем порядке. * - обозначается все колонки */
        $result = mysqli_query($link, $query); /* Все что мы отобрали (САМ ЗАПРОС) записываем в переменную $result */

        if (!$result) /* Если произошла ошибка, восклицательный знак - логическая инверсия */
            die(mysqli_error($link)); /* приостанавливаем работу скрипта и выводим ошибку. В $link содержится инфа
            дескриптора */
            /* Если все прошло успешно мы получаем количество строк которое нам вернула база */

        /* Функция fetch_all преобразует массив в который у нас в $result
        в правильный(ключ - значение) массив */
        /* Второй параметр делает именно НАШИ ключи точкой отсчета и приравнивает данные
        к ключам, Ежели без параметра будут приравниватся к отсчету с нуля */
        $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);

            return $articles; /* возвращаем результат в название функции */
    }

    /* Получение определенной статьи по id */
    function articles_get($link, $id_article) /* вторая переменная действует только внутри функции */
    {
       /* sprintf — Возвращает отформатированную строку */
        $query = sprintf("SELECT * FROM articles WHERE id=%d", (int)$id_article); /* Выборка из таблицы по всем
    столбцам из таблицы articles где id равняется входящей в параметры переменной $id_article КОТОРАЯ является
    параметром $_GET['id'] (из get_article.php) который получил идшник нужной статьи из url'a  */

        $result = mysqli_query($link, $query); /* Все что мы отобрали (САМ ЗАПРОС) записываем в переменную $result */

        if (!$result) /* если запрос не выополнился */
            die(mysqli_fetch_assoc($link)); /* сообщаем о ошибке */

        $article = mysqli_fetch_assoc($result); /* Получаем результат в виде ассоциативного массива */

        return $article; /* возращаем в функцию */
    }

    /* Создание новой статьи через админку */
    function articles_new($link, $title, $date, $content){

        //Пордготовка.
        $title = trim($title);/* команда trim убирает слева и справа пробелы в тайтле и контенте, если они присуств. */
        $content = trim($content);

        //Проверка.
        if ($title == '') return false; /* если тайтс пустой возвращаем фолс */

        //Запрос на добавление в базу столбцов
        $t = "INSERT INTO articles (title, date, content) /*Вставить в таблицу articles  title, date и content */
        VALUES ('%s', '%s', '%s')"; /* В точно таком же порядке передаем значения! %s - означает string(строковые) */

        /* sprintf — Возвращает отформатированную строку */
        $query = sprintf($t, mysqli_real_escape_string($link, $title), /* берет $t и вместо процента вставляет title */
                            mysqli_real_escape_string($link, $date), /* date */
                            mysqli_real_escape_string($link, $content)); /* и content */
        /* mysqli_real_escape_string позволяет экранировать входящую строку, обезопасить себя от sql инъекции */

        $result = mysqli_query($link, $query); /* Все что мы отобрали (САМ ЗАПРОС) записываем в переменную $result */

        if (!$result) /* если ошибка */
            die (mysqli_error($link)); /* прекратить выполнение скрипта и вывести сообщ об ошибке */

        return true; /* если данные успешно добавились возвращаем true */
    }

    /* Обновляет содержимое уже существующей статьи */
    function articles_edit($link, $id, $title, $date, $content){

        $title = trim($title);
        $content = trim($content);
        $date = trim($date);
        $id = (int)$id;

        //Проверка
        if ($title == '') /* Если пустой заголовок */
            return false; /* не выполняем ничего */

        //Запрос
        $sql = "UPDATE articles SET title='%s', content='%s', date='%s' WHERE id='%d'";
        /* Обновить таблицу articles, в качестве параметров подставляем значения ниже, где ид - последний параметр  */

        /* Берем нашу $sql и посставляем значения ниже  */
        /* mysqli_real_escape_string (экранирует) подставляет обратный слэш (/)  перед теми символами которые могут
        испорить sql запрос */
        $query = sprintf($sql,  mysqli_real_escape_string($link, $title),
                                mysqli_real_escape_string($link, $content),
                                mysqli_real_escape_string($link, $date),
                                $id);

        $result = mysqli_query($link, $query); /* выполнение запроса */

        if (!$result) /* если небыло ничего */
            die(mysqli_error($link)); /* приостановить работу, вывести ошибку */

        return mysqli_affected_rows($link); /* Если все гуд, возвращаем кол-во статей которое было успешно отредактировано */
    }

    /* Удаляет статью */
    function articles_delete($link, $id){

        $id = (int)$id; /* конвертируем в integer хз зачем */
        //Проверка
        if ($id == 0) return false;

        //Запрос
        $query = sprintf("DELETE FROM articles WHERE id='%d'", $id);
        /* удалить из табл articles строку в которой ид = $id  */
        $result = mysqli_query($link, $query);

        if (!$result)
            die (mysqli_error($link));

        return mysqli_affected_rows($link); /* Возвращает число строк, затронутых последним INSERT, UPDATE, REPLACE или
        DELETE запросом.*/
    }

    /*Обрезка статей на главной странице не больше 500 символов */
    function articles_intro ($text, $len = 500) /* $text - сам текст, $len - желаемая длинна */
    {
        return mb_substr($text, 0, $len); /* функция multibyte substr - копирует $text начиная с 0 позиции длинной $len */
    }

    function sort_name_user ($link, $sort){
        //Запрос.
        $query = "SELECT name_user FROM articles '$sort'";
        $result = mysqli_query($link, $query);

        if (!$result)
            die(mysqli_error($link));

        $sort_name = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $sort_name; /* возвращаем результат в название функции */
    }

?>