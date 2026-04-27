<?php
class UserInfo {
    public static function getInfo(): array {
        return [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'browser' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'time' => date('H:i:s')
        ];
    }
}
