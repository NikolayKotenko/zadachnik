<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Добавление статьи</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Добавление статьи</h1>
    <div>
        <!-- Атрибут action - говорит о том что данные передавать скрипту -->
        <!-- Method - каким способом будут передаваться параметры.-->
        <form method="post" action="../admin-panel/index.php?action=<?=$_GET['action']?>&id=<?=$_GET['id']?> ">
        <!-- Метод post посылает на сервер данные в запросе браузера, в отличие от get передает не отображая в url -->
        <!-- Ссылка именно на index.php потому что в начале мы добавили/редактировали статью, потом инклюдили файл
        table_articles_admin-panel.php в котором отображалось все новое -->
        <!-- $_GET['action'] - позвояет в зависимости от того редактируем мы или создаем статью изменять параметр action
        т.е считываем значение action из url если он = edit - отправ будет по адресу action=edit. add по аналогии -->
        <!-- $_GET['id'] - считывает id c url -->
            <label>id
                <input type="text" name="id" value="<?=$post_null_get_article['id']?>" class="form-item" autofocus required>
            </label> <br>
            <label>
                Название
                <input type="text" name="title" value="<?=$post_null_get_article['title']?>" class="form-item" autofocus required>
                <!-- required применяет стилевые правила к тегу <input>,  Он позволяет выделять поля
                обязательные к заполнению перед отправкой формы. -->
                <!-- Атрибут autofocus устанавливает, что кнопка получает фокус после загрузки страницы. -->
            </label>
            <label>
                Дата
                <input type="date" name="date" value="<?=$post_null_get_article['date']?>" class="form-item" autofocus required>
            </label>
            <label>
                Содержимое
                <textarea class="form-item"  name="content" required><?=$post_null_get_article['content']?></textarea>
            </label>
            <input type="submit" value="Сохранить" class="btn">
        </form>
    </div>
</div>
</body>
</html>