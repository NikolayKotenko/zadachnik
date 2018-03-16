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
        <div class="article">
            <h3> <?=$article['name_user']?> </h3> <!-- Выводим переменную $article которая является массивом с
            ключом title -->
            <em>Опубликовано: <?= $article['e-mail'] ?> </em>
            <p> <?= $article['text_zadachi'] ?> </p>
        </div>
    </div>
    <footer>
        <p>Мой первый блог<br>Copyright &copy; 2015</p>
    </footer>
</div>
</body>
</html>