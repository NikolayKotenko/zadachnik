<?php
define('MYSQL_SERVER','localhost');
define('MYSQL_USER','root');
define('MYSQL_PASSWORD','');
define('MYSQL_DB','zadachnik');

    function db_connect() {
        $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) /* Mysqli_connect возвращает
 дескриптор соединения мы его сохраняем в переменной $link и дальще пользуемся им каждый раз когда нужно
 подключение к базе  */
            or die("Error: ".mysqli_error($link));
        if (!mysqli_set_charset($link, "utf8")) {
            printf("Error: ".mysqli_error($link));
        }

        return $link;
}
?>