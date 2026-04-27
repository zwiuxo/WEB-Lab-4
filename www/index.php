<?php
session_start();

require_once 'UserInfo.php';
$info = UserInfo::getInfo();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab 4</title>
    <style>
        body { background: #1a1a1a; color: white; font-family: sans-serif; }
        .box { border: 2px solid yellow; padding: 10px; margin: 10px; }
        h3 { color: yellow; }
        button { background: yellow; padding: 5px; cursor: pointer; }
    </style>
</head>
<body>

    <h1>API</h1>

    <div class="box">
        <h3>Информация о пользователе:</h3>
        <p>Ваш ip: <?php echo $info['ip']; ?></p>
        <p>Браузер: <?php echo $info['browser']; ?></p>
        <p>Время: <?php echo $info['time']; ?></p>
    </div>

    <div class="box">
        <h3>Где сейчас такси:</h3>
        <?php if (isset($_SESSION['api_data'])): ?>
            <p>Страна: <?php echo $_SESSION['api_data']['countryName']; ?></p>
            <p>Город: <?php echo $_SESSION['api_data']['city']; ?></p>
            <p>Место: <?php echo $_SESSION['api_data']['locality']; ?></p>
        <?php else: ?>
            <p>Сначала закажите такси в фроме</p>
        <?php endif; ?>
        
        <br>
        <button onclick="location.reload()">Обновить данные</button>
    </div>

    <p><a href="form.html" style="color:yellow">Вернуться назад</a></p>

</body>
</html>
