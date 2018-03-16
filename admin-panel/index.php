<?php
    require_once ("../database.php"); /* подключение к базе */
    require_once ("../models/articles.php"); /* сама логика, выборка (MVC модель)*/

    $link = db_connect(); /* непонял зачем делать это еще раз */

    if(isset($_GET['action'])) /* Если у нас есть входящие данные с параметром action, а они у нас есть add,edit,delete */
        $action = $_GET['action']; /* Тогда значение массива с параметром action записываем в переменную $action */
    else /* если такого параметра нет */
        $action = ""; /* тогда переменную сделаем пустой */

    // Добавление статьи
    if ($action == "add"){ /* если в переменной находится параметр add, а он есть только в ссылке на добавление статьи */
        if(!empty($_POST)) { /* Если запрос данных POST не пустой */
            articles_new($link, $_POST['title'], $_POST['date'], $_POST['content']); /* посылаем данные в функцию
            articles_new (файл с логикой) где параметрами являются введеные в инпут данные в файле
            views/form_add_new_article_admin-panel.php которые передали методом POST в этот файл  */
            header("Location: ../admin-panel/index.php"); /* Направляет нас после добавления новой статьи в админку
            index.php для проверки нет ли чего нового в get и post и если нет выводятся тупо все статьи которые есть */
        }
//        include("../views/table_articles_admin-panel.php"); /* подгружаем шаблон в котором будет добавлять новую статью */
    }
    // Редактирование статьи
    else if ($action == "edit") { /* если входящий параметр action == edit */
        if(!isset($_GET['id'])) /* Если не установлен параметр id, мы не знаем какую статью откр для редактирования */
            header("Location: ../admin-panel/index.php"); /* тогда перенаправляем на index.php */
        $id = (int)$_GET['id']; /* Если параметр id задан, конвертируем его в тип integer и записываем в $id */
        /* если id будет строкой то $id = 0 */

        if (!empty($_POST) && $id > 0) { /* Если параметр POST не пустой и если $id > 0 */
            articles_edit($link, $id, $_POST['title'], $_POST['date'], $_POST['content']); /* сохраняем данную статью */
            /* вызываем функцию articles_edit передаем соед с базой, ид, новые: тайтл, дату, контент  */
            header("Location: ../admin-panel/index.php"); /* перенаправляем */
        }
/* Если POST данные пустые, то необх отобразить html страницу с содержимым данной статьи доступным для редактирования  */
        $post_null_get_article = articles_get($link, $id); /* получаем статью из базы */
        include("../views/form_add_new_article_admin-panel.php"); /* подключаем сформированную админ панель */
    }

    //Удаление статьи
    else if($action == "delete") { /* если входящий параметр action == delete */
        $id = $_GET['id']; /* Присваиваем идшник из url переменной $id */
        $delete_article = articles_delete($link, $id); /* в функцию articles_delete передается соединение и ид */
        header("Location: ../admin-panel/index.php"); /* перенаправляем */
    }

    /* ! При первом заходе в админ панель начинается отсюда так как нету переданных статей через get, post */
    else { /* если никаких параметров небыло передано */
        $articles_table = articles_all($link); /* сформировали все статьи которые уже есть! */
        include("../views/table_articles_admin-panel.php"); /* подключили табличку админки!  */
    }


    if ($action=="sort1"){
        if (isset($_GET['sort']) && $_GET['sort'] == 1) {
            $sort = "ORDER BY name_user ASC";
        }
        else if(isset($_GET['sort']) && $_GET['sort'] == 2){
            $sort = "ORDER BY name_user DESC";
        }
        else {
            $sort = "";
        }
        sort_name_user($link, $sort);
        header("Location:../index.php");
    }

?>