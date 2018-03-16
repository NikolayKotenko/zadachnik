<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Мой первый блог</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Мой первый бложик</h1>
    <div>

        <a href="../views/form_add_new_article_admin-panel.php">Добавить статью</a> <!-- Ссылка скрытого пула) в файле admin-panel
        /index.php в обработке добавления статей - header("Location: index.php") - грубо говоря спец лейбл с параметром add -->
        <a href="../index.php">Главная страница со статьями</a>
        <table class="admin-table" border="1">
            <tr>
                <th>Дата</th>
                <th>Заголовок</th>
                <th></th>
                <th></th>
            </tr>
<pre>
    <?php
    var_dump($articles_table);
    ?>
</pre>
        <?php foreach ($articles_table as $a): ?> <!-- Проходимся по каждому элементу массива
        $articles_table(admin-panel/index.php) и при каждой итерации элемент массива будет присвоен переменной $a -->

            <tr>
                <td><?=$a['date']?></td>
                <td><?=$a['title']?></td>
                <td>
                    <a href="../admin-panel/index.php?action=edit&id=<?=$a['id']?>">Редактировать</a> <!-- будем редактировать статью
                    через параметр action=edit где id это идшник нашей статьи -->
                </td>
                <td>
                    <!-- модалка с подтверждением удаления -->
                    <a onclick = "return confirm('Вы уверены?')"
                       href="../admin-panel/index.php?action=delete&id=<?=$a['id']?>">Удалить</a>
                </td>
            </tr>

        <?php endforeach; ?>

        </table>

    </div>
    <footer>
        <p>Мой первый блог<br>Copyright &copy; 2015</p>
    </footer>
</div>
</body>
</html>