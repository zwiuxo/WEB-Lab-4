<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все данные такси</title>
    <style>
        body { background: #1a1a1a; color: #f1f1f1; font-family: Arial; padding: 20px; }
        h2 { color: #ffcc00; }
        a { color: #ffcc00; }
        li { margin-bottom: 10px; border-bottom: 1px solid #333; padding-bottom: 5px; }
    </style>
</head>
<body>
    <h2>Все сохранённые заказы:</h2>
    <ul>
        <?php
        if(file_exists("data.txt")){
            $lines = file("data.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach($lines as $line){
                list($name, $pass_count, $type, $car, $bag) = explode(";", $line);
                echo "<li><b>Имя:</b> $name | <b>Пассажиров:</b> $pass_count | <b>Тариф:</b> $type | <b>Авто:</b> $car | <b>Багаж:</b> $bag</li>";
            }  
        } else {
            echo "<li>Данных нет</li>";
        }
        ?>
    </ul>
    <br>
    <a href="index.php">На главную</a>
</body>
</html>
