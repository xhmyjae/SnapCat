<?php

namespace App\Abstract;

class FlashMessage
{
    public static function getFlashes(string $type) {
        if(isset($_SESSION[$type])) {
            $x = $_SESSION[$type];
            unset($_SESSION[$type]);
            return $x;
        }
        return [];
    }

    public function setFlashes(string $type, string $message) {
        if(!isset($_SESSION[$type])) {
            $_SESSION[$type] = [];
        };
        $_SESSION[$type][] = $message;
    }
}