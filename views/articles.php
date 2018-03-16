<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Мой первый блог</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <style>
        html, body {
            font-size: 10pt;
        }
        th, table {
            text-align: center;
            font-size: 10pt;
        }
        th, td {
            padding: 5px;
        }
        table{
            width: 100%;
            table-layout: fixed;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Мой первый бложик</h1>
    <a href="../admin-panel/index.php">Панель администратора</a> <!-- Ссылка именно на index.php потому что в начале
    мы сформировали таблицу статей, потом инклюдили файл table_articles_admin-panel.php в котором отображали все -->
    <div>
<?
//    var_dump(sort_name_user($link));
?>

        <table class="admin-table" border="1">
            <tr>
                <th><a href="../admin-panel/index.php?action=sort_name">
                        <a href="../admin-panel/index.php?action=sort1">по возрастанию</a><bR>
                        <a href="../admin-panel/index.php?action=sort2">по убыванию</a>
                    <br>Имя пользователя
                    </a>
                </th>
                <th width="100px">е-mail</th>
                <th>Текст задачи</th>
                <th>Картинка</th>
                <th>Статус</th>
            </tr>

        <?php foreach ($articles as $a): ?> <!-- Проходимся по каждому элементу массива $articles(index.php)
        и при каждой итерации элемент массива будет присвоен переменной $a -->

        <div class="article">
            <tr>
                <td>
                    <a href="../get_article.php?id= <?=$a['id']?> "> <!-- При нажатии на тайтл переходим на get_article.php
                 где id берется из $a -->
                    <?=$a['name_user']?> </a>
                </td>
                <td><?=$a['e-mail']?> </td>
                <td> <p> <?=articles_intro($a['text_zadachi'])?> </p></td> <!-- посылаем в функцию articles_intro (файл с логикой)
            полученный контент, она обратно возвращает обрезанный в 500 символов текст для главной страницы -->
                <td></td>
                <td></td>
            </tr>
        </div>

       <?php endforeach; ?>
        </table>

    </div>
    <footer>
        <p>Мой первый блог<br>Copyright &copy; 2015</p>
    </footer>
</div>
</body>
</html>