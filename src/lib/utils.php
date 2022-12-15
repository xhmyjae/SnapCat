<?php

namespace App\Lib\Utils;

function redirect(string $url): never
{
    header("Location: $url");
    exit();
}

function checkHash(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}
