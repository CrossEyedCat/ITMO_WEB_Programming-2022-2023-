<!DOCTYPE html>
<html>
<head>
    <title>Лабораторная работа №1 //Зенкевич Артем</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="./css/style2.css">
</head>
<body>
<?php
        ini_set('display_errors', 0);
        error_reporting(0);
        //запоминаем время начала работы скрипта
        $start = microtime(true);
        //получаем дату и время по москве
        date_default_timezone_set('Europe/Moscow');
        $now= date("d.m.y H:i");
        //получаем параметры из index.php

        $coordXSee=$_GET['paramX'];
        $coordYSee=$_GET['paramY'];
        if($coordXSee=="" || $coordYSee==""){
            session_unset();
            if($coordXSee=="" && $coordYSee==""){
                $message="Вы не ввели значение X и Y";
            }else if($coordXSee==""){
                $message="Вы не ввели значение X";
            }
            else if($coordYSee==""){
                $message="Вы не ввели значение Y";
            }
        }else {
            $paramR = $_GET['paramR'];
            //меняем в Y и X запятую на точку
            $coordNY = explode(",", $coordYSee);
            $coordNX = explode(",", $coordXSee);
            $coordY = $coordNY[0] . "." . $coordNY[1];
            $coordX = $coordNX[0] . "." . $coordNX[1];
            //готовимся к вычислению попадания в область
            $halfR = $paramR / 2;
            $chetvert = 0;
            //узнаём четверть, в которой располагается точка
            if ($coordX <= 0 && $coordY >= 0) $chetvert = 2;
            if ($coordX >= 0 && $coordY >= 0) $chetvert = 1;
            if ($coordX <= 0 && $coordY <= 0) $chetvert = 3;
            if ($coordX >= 0 && $coordY <= 0) $chetvert = 4;
            if ($chetvert == 1) {
                if ($coordX >= -$halfR && $coordY <= $paramR) {
                    $message = "Точка входит в область";
                } else {
                    $message = "Точка не входит в область";
                }
            }

            if ($chetvert == 2) {
                if ($coordX >= -$halfR && $coordY<=$paramR) {
                    $message = "Точка входит в область";
                } else {
                    $message = "Точка не входит в область";
                }
            }

            if ($chetvert == 3) {
                if ($coordX + $coordY >= -$halfR) {
                    $message = "Точка входит в область";
                } else {
                    $message = "Точка не входит в область";
                }
            }

            if ($chetvert == 4) {
                $distance = $coordX * $coordX + $coordY * $coordY;
                if ($distance > $halfR*$halfR) {
                    $message = "Точка не входит в область";
                } else {
                    $message = "Точка входит в область";
                }
            }
            //получаем время окончания работы скрипта
            $finish = microtime(true);
            //высчитываем время работы (разницу) и округляем
            $timeWork = $finish - $start;
            $timeWork = round($timeWork, 7);
            //заполняем переменную сессии для отображения всей таблицы
            $ses = $_SESSION['counter'];
            $ses++;
            $_SESSION['str_' . $ses] = "    <tr>
        <td> $now</td>
        <td> $timeWork с</td>
        <td>$coordX </td>
        <td> $coordYSee </td>
        <td> $paramR </td>
        <td> $message </td>
    </tr>";
        }
?>
<!--Выводим сообщение о результате-->
<link rel="stylesheet" href="css/style2.css">
<h3 class="message_return"><?php echo $message; ?></h3>
<br>
<table>
    <tr>
        <td>Дата и время запроса</td>
        <td>Время выполнения</td>
        <td>Координата X</td>
        <td>Координата Y</td>
        <td>Параметр R</td>
        <td>Результат</td>
    </tr>
    <?php
    if($ses>5){
        $m = $ses-5;
    }
    else{
        $m = 1;
    }
    for(;$m<=$ses;$m++){
        echo $_SESSION['str_'.$m];
    }
    ?>
    <script>

    </script>
</table>
</body>
</html>