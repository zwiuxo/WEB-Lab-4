<?php
class UserInfo {
    public static function getInfo(): array {
        return [
            'IP-адрес' => $_SERVER['REMOTE_ADDR'] ?? 'Не определен',
            'Браузер' => $_SERVER['HTTP_USER_AGENT'] ?? 'Не определен',
            'Дата и время' => date('Y-m-d H:i:s')
        ];
    }
}
