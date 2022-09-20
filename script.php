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
            if ($coordX >= 0 && $coordY >= 0) $chetvert = 2;//правая верхняя
            if ($coordX <= 0 && $coordY >= 0) $chetvert = 1;//левая верхняя
            if ($coordX >= 0 && $coordY <= 0) $chetvert = 3;//правая нижняя
            if ($coordX <= 0 && $coordY <= 0) $chetvert = 4;//левая нижняя
            if ($chetvert == 1) {//в этой четверти совсем нет области, так что всё просто
                if ($coordX >= -$halfR && $coordY <= $paramR) {
                    $message = "Точка входит в область";
                } else {
                    $message = "Точка не входит в область";
                }
            }

            if ($chetvert == 2) {//вспоминаем уравнение наклонной прямой y=kx+b, где b=-1, и если ниже, то входит, если выше, то нет
                if (($coordX <= $halfR && $coordY == 0) || ($coordY <= $paramR && $coordX == 0)) {
                    $message = "Точка входит в область";
                } else {
                    $message = "Точка не входит в область";
                }
            }

            if ($chetvert == 3) {//поскольку прямоугольник, то X<=R и Y<=R/2. Если да, то в области. нет - нет
                if ($coordX + $coordY >= -$paramR) {
                    $message = "Точка входит в область";
                } else {
                    $message = "Точка не входит в область";
                }
            }

            if ($chetvert == 4) {//окружность с центром в точке (0;0). Находим расстояние от нашей точки до центра окружности, и если оно больше R/2, то точка не в области.
                $distance = $coordX * $coordX + $coordY * $coordY;
                $distance = sqrt($distance);
                if ($distance > $halfR) {
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
	//таблица истории введённых значений. Работает на костылях и некрасиво, но работает
    for($m=1;$m<=$ses;$m++){
        echo $_SESSION['str_'.$m];
    }

    ?>
</table>
</body>
</html>