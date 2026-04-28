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
        button { background: yellow; padding: 10px; cursor: pointer; border: none; font-weight: bold; }
        .loading { opacity: 0.5; }
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
        <div id="api-data">
            <?php if (isset($_SESSION['api_data'])): ?>
                <p>Страна: <span id="country"><?php echo $_SESSION['api_data']['countryName']; ?></span></p>
                <p>Город: <span id="city"><?php echo $_SESSION['api_data']['city']; ?></span></p>
                <p>Место: <span id="locality"><?php echo $_SESSION['api_data']['locality']; ?></span></p>
            <?php else: ?>
                <p>Сначала закажите такси в форме</p>
            <?php endif; ?>
        </div>
        
        <br>
        <button id="update-btn" onclick="refreshApi()">Обновить данные (fetch)</button>
    </div>

    <p><a href="form.html" style="color:yellow">Вернуться назад</a></p>

    <script>
    function refreshApi() {
        const btn = document.getElementById('update-btn');
        const box = document.getElementById('api-data');
        
        btn.innerText = 'Загрузка...';
        box.classList.add('loading');
        fetch('process.php?ajax=1')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Ошибка: ' + data.error);
                } else {
                    document.getElementById('country').innerText = data.countryName;
                    document.getElementById('city').innerText = data.city;
                    document.getElementById('locality').innerText = data.locality;
                }
            })
            .catch(err => alert('Сетевая ошибка'))
            .finally(() => {
                btn.innerText = 'Обновить данные (fetch)';
                box.classList.remove('loading');
            });
    }
    </script>
</body>
</html>
